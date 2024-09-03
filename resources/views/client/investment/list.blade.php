<!DOCTYPE html>
<html lang="en">
  @include('structures.head')
  <body class="  ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        @include('structures.sidebar')
        @include('structures.topbar')
        <div class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="card">
                        <div class="card-header d-flex justify-content-between">
                           <div class="header-title">
                              <h4 class="card-title">Investments</h4>
                           </div>
                        <div class="header-action">
                                 {{-- <i data-toggle="collapse" data-target="#datatable-1" aria-expanded="false">
                                    <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                    </svg>
                                 </i> --}}
                                 <button type="button" id="add-investment-button" class="btn theme-btn rounded-pill mt-2">Add Investment</button>
                              </div>
                        </div>
                        <div class="card-body">
                           <div class="collapse" id="datatable-1">
                                 {{-- <div class="card"><kbd class="bg-dark"><pre id="bootstrap-datatables" class="text-white"></pre></kbd></div> --}}
                              </div>
                           {{-- <p>Images in Bootstrap are made responsive with <code>.img-fluid</code>. <code>max-width: 100%;</code> and <code>height: auto;</code> are applied to the image so that it scales with the parent element.</p> --}}
                           <div class="table-responsive">
                              <table id="caseListTable" class="table table-bordered table-striped">
                                <thead class="thead-gold">
                                <tr>
                                  <th>ID</th>
                                  <th>Type</th>
                                  <th>Amount</th>
                                  <th>Institution</th>
                                  <th>Maturity Date</th>
                                  <th>Category</th>
                                  <th>Note</th>
                                  <th>Status</th>
                                  <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="tbody-green">
                                </tbody>
                              </table>
                           </div>
                        </div>                  
                     </div>
                  </div>
               </div>
            </div>
        </div>
    </div>
    @include('structures.footer')
    @include('structures.footer_scripts')
    <script>
        $(function () {
            
            $('#caseListTable').DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                processing: true,
                serverSide: true,
                contentType: "application/json",
                ajax: {
                    url:"{{route('investments.get_list_for_user')}}",
                    type:"POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                },
                columns: [
                    { data: 'id',orderable:false,visible:false},
                    { data: 'type' }, 
                    { 
                        data: 'amount',
                        render: function (data, type, row) {
                            return `₹${data}`;
                        }
                    },
                    { data: 'institution' },
                    { data: 'maturity_date' },
                    { 
                        data: 'category',
                        orderable: false,
                        render: function (data, type, row) {
                            console.log(data,type,row);
                            let badges = '';
                            data.forEach((item) => {
                                badges += `
                                    <span class="mt-2 badge badge-pill badge-warning">${item.tag}</span>
                                `;
                            });
                            return badges;
                        }

                    },
                    { data: 'note' },
                    { 
                        data: 'status',
                        render: function (data, type, row) {
                            console.log(data,type,row);
                            let badgeClass = data == '1' ? 'btn-success' : 'btn-danger';
                            let badgeName = data == '1' ? 'Active' : 'Inactive';
                            let badgeUrl = data == '1' ? row.urls.deactivation_url : row.urls.activation_url;
                            return `
                                <a href="${badgeUrl}" class="mt-2 badge ${badgeClass}">${badgeName}</a>
                            `;
                        }
                    },
                    { 
                        data: 'actions',
                        orderable: false,
                        render: function (data, type, row) {
                            let buttonClass = data == '1' ? 'btn-success' : 'btn-danger';
                            let buttonText = data == '1' ? 'Active' : 'Inactive';
                            return `
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn action-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="${row.urls.edit_url}">Edit Details</a>
                                        <a class="dropdown-item" href="${row.urls.deletion_url}">Delete</a>
                                    </div>
                                </div>
                            `;
                        }
                    }
                ],
                "pagingType": "full_numbers",
                "drawCallback": function(settings) {
    var api = this.api();
    var pagination = $(api.table().container()).find('.dataTables_paginate');
    var pageInfo = api.page.info();

    // Define the number of pages to show
    var maxPages = 4;
    var startPage, endPage;

    if (pageInfo.pages <= maxPages) {
        startPage = 0;
        endPage = pageInfo.pages - 1;
    } else {
        var half = Math.floor(maxPages / 2);
        if (pageInfo.page <= half) {
            startPage = 0;
            endPage = maxPages - 1;
        } else if (pageInfo.page >= (pageInfo.pages - half - 1)) {
            startPage = pageInfo.pages - maxPages;
            endPage = pageInfo.pages - 1;
        } else {
            startPage = pageInfo.page - half;
            endPage = pageInfo.page + half;
        }
    }

    var paginationHtml = `
        <nav aria-label="Page navigation example">
           <ul class="pagination">
              <li class="page-item ${pageInfo.page === 0 ? 'disabled' : ''}">
                    <a class="page-link text-white" href="#" data-page="previous">Previous</a>
              </li>
              ${Array.from({length: endPage - startPage + 1}, (_, i) => {
                    var pageNum = startPage + i;
                    return `<li class="page-item ${pageNum === pageInfo.page ? 'active' : ''}">
                       <a class="page-link text-white" href="#" data-page="${pageNum + 1}">${pageNum + 1}</a>
                    </li>`;
              }).join('')}
              <li class="page-item ${pageInfo.page === pageInfo.pages - 1 ? 'disabled' : ''}">
                    <a class="page-link text-white" href="#" data-page="next">Next</a>
              </li>
           </ul>
        </nav>
    `;

    // Update pagination
    pagination.html(paginationHtml);

    // Handle custom pagination clicks
    pagination.find('a').on('click', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        if (page === 'previous') {
            api.page('previous').draw('page');
        } else if (page === 'next') {
            api.page('next').draw('page');
        } else {
            api.page(parseInt(page) - 1).draw('page');
        }
    });
},

            });

            if ('{{$user_details->category_seen}}' === '0') {
               $('#exampleModalCenter').modal('show');
    } else {   
        console.log('No');
    }

    const addInvestmentButton = document.getElementById('add-investment-button');

      addInvestmentButton.addEventListener('click',function(){
         window.location.href="{{route('investments.add_investments')}}";
      });
        });
    </script>
</body>
</html>