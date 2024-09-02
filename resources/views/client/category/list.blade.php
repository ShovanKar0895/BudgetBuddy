<!DOCTYPE html>
<html lang="en">
  @include('structures.head')
  <style>
    /* .pagination .page-item.active .page-link {
        background-color: #1b3e83 !important;
        border-color: #142953 !important;
        color: #fff !important;
    }
    .pagination .page-item.disabled .page-link {
        background-color: #6b89c3 !important;
        border-color: #142953 !important;
        color: #fff !important;
    } */

    
  </style>
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
                              <h4 class="card-title">Category Management</h4>
                           </div>
                        <div class="header-action">
                                 {{-- <i data-toggle="collapse" data-target="#datatable-1" aria-expanded="false">
                                    <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                    </svg>
                                 </i> --}}
                                 <button type="button" id="add-category-button" class="btn theme-btn rounded-pill mt-2">Add Category</button>
                              </div>
                        </div>
                        <div class="card-body">
                           <div class="collapse" id="datatable-1">
                                 {{-- <div class="card"><kbd class="bg-dark"><pre id="bootstrap-datatables" class="text-white"></pre></kbd></div> --}}
                              </div>
                           {{-- <p>Images in Bootstrap are made responsive with <code>.img-fluid</code>. <code>max-width: 100%;</code> and <code>height: auto;</code> are applied to the image so that it scales with the parent element.</p> --}}
                           <div class="table-responsive">
                              {{-- <table id="datatable-1" class="table data-table table-striped table-bordered" >
                                 <thead>
                                    <tr>
                                       <th>Name</th>
                                       <th>Position</th>
                                       <th>Office</th>
                                       <th>Age</th>
                                       <th>Start date</th>
                                       <th class="text-right">Salary</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>Tiger Nixon</td>
                                       <td>System Architect</td>
                                       <td>Edinburgh</td>
                                       <td>61</td>
                                       <td>2011/04/25</td>
                                       <td class="text-right">$320,800</td>
                                    </tr>
                                    <tr>
                                       <td>Garrett Winters</td>
                                       <td>Accountant</td>
                                       <td>Tokyo</td>
                                       <td>63</td>
                                       <td>2011/07/25</td>
                                       <td class="text-right">$170,750</td>
                                    </tr>
                                    <tr>
                                       <td>Ashton Cox</td>
                                       <td>Junior Technical Author</td>
                                       <td>San Francisco</td>
                                       <td>66</td>
                                       <td>2009/01/12</td>
                                       <td class="text-right">$86,000</td>
                                    </tr>
                                    <tr>
                                       <td>Cedric Kelly</td>
                                       <td>Senior Javascript Developer</td>
                                       <td>Edinburgh</td>
                                       <td>22</td>
                                       <td>2012/03/29</td>
                                       <td class="text-right">$433,060</td>
                                    </tr>
                                    <tr>
                                       <td>Airi Satou</td>
                                       <td>Accountant</td>
                                       <td>Tokyo</td>
                                       <td>33</td>
                                       <td>2008/11/28</td>
                                       <td class="text-right">$162,700</td>
                                    </tr>
                                    <tr>
                                       <td>Brielle Williamson</td>
                                       <td>Integration Specialist</td>
                                       <td>New York</td>
                                       <td>61</td>
                                       <td>2012/12/02</td>
                                       <td class="text-right">$372,000</td>
                                    </tr>
                                    <tr>
                                       <td>Herrod Chandler</td>
                                       <td>Sales Assistant</td>
                                       <td>San Francisco</td>
                                       <td>59</td>
                                       <td>2012/08/06</td>
                                       <td class="text-right">$137,500</td>
                                    </tr>
                                    <tr>
                                       <td>Rhona Davidson</td>
                                       <td>Integration Specialist</td>
                                       <td>Tokyo</td>
                                       <td>55</td>
                                       <td>2010/10/14</td>
                                       <td class="text-right">$327,900</td>
                                    </tr>
                                    <tr>
                                       <td>Colleen Hurst</td>
                                       <td>Javascript Developer</td>
                                       <td>San Francisco</td>
                                       <td>39</td>
                                       <td>2009/09/15</td>
                                       <td class="text-right">$205,500</td>
                                    </tr>
                                    <tr>
                                       <td>Sonya Frost</td>
                                       <td>Software Engineer</td>
                                       <td>Edinburgh</td>
                                       <td>23</td>
                                       <td>2008/12/13</td>
                                       <td class="text-right">$103,600</td>
                                    </tr>
                                    <tr>
                                       <td>Jena Gaines</td>
                                       <td>Office Manager</td>
                                       <td>London</td>
                                       <td>30</td>
                                       <td>2008/12/19</td>
                                       <td class="text-right">$90,560</td>
                                    </tr>
                                    <tr>
                                       <td>Quinn Flynn</td>
                                       <td>Support Lead</td>
                                       <td>Edinburgh</td>
                                       <td>22</td>
                                       <td>2013/03/03</td>
                                       <td class="text-right">$342,000</td>
                                    </tr>
                                    <tr>
                                       <td>Charde Marshall</td>
                                       <td>Regional Director</td>
                                       <td>San Francisco</td>
                                       <td>36</td>
                                       <td>2008/10/16</td>
                                       <td class="text-right">$470,600</td>
                                    </tr>
                                    <tr>
                                       <td>Haley Kennedy</td>
                                       <td>Senior Marketing Designer</td>
                                       <td>London</td>
                                       <td>43</td>
                                       <td>2012/12/18</td>
                                       <td class="text-right">$313,500</td>
                                    </tr>
                                    <tr>
                                       <td>Tatyana Fitzpatrick</td>
                                       <td>Regional Director</td>
                                       <td>London</td>
                                       <td>19</td>
                                       <td>2010/03/17</td>
                                       <td class="text-right">$385,750</td>
                                    </tr>
                                    <tr>
                                       <td>Michael Silva</td>
                                       <td>Marketing Designer</td>
                                       <td>London</td>
                                       <td>66</td>
                                       <td>2012/11/27</td>
                                       <td class="text-right">$198,500</td>
                                    </tr>
                                    <tr>
                                       <td>Paul Byrd</td>
                                       <td>Chief Financial Officer (CFO)</td>
                                       <td>New York</td>
                                       <td>64</td>
                                       <td>2010/06/09</td>
                                       <td class="text-right">$725,000</td>
                                    </tr>
                                    <tr>
                                       <td>Gloria Little</td>
                                       <td>Systems Administrator</td>
                                       <td>New York</td>
                                       <td>59</td>
                                       <td>2009/04/10</td>
                                       <td class="text-right">$237,500</td>
                                    </tr>
                                    <tr>
                                       <td>Bradley Greer</td>
                                       <td>Software Engineer</td>
                                       <td>London</td>
                                       <td>41</td>
                                       <td>2012/10/13</td>
                                       <td class="text-right">$132,000</td>
                                    </tr>
                                    <tr>
                                       <td>Dai Rios</td>
                                       <td>Personnel Lead</td>
                                       <td>Edinburgh</td>
                                       <td>35</td>
                                       <td>2012/09/26</td>
                                       <td class="text-right">$217,500</td>
                                    </tr>
                                    <tr>
                                       <td>Jenette Caldwell</td>
                                       <td>Development Lead</td>
                                       <td>New York</td>
                                       <td>30</td>
                                       <td>2011/09/03</td>
                                       <td class="text-right">$345,000</td>
                                    </tr>
                                    <tr>
                                       <td>Yuri Berry</td>
                                       <td>Chief Marketing Officer (CMO)</td>
                                       <td>New York</td>
                                       <td>40</td>
                                       <td>2009/06/25</td>
                                       <td class="text-right">$675,000</td>
                                    </tr>
                                    <tr>
                                       <td>Caesar Vance</td>
                                       <td>Pre-Sales Support</td>
                                       <td>New York</td>
                                       <td>21</td>
                                       <td>2011/12/12</td>
                                       <td class="text-right">$106,450</td>
                                    </tr>
                                    <tr>
                                       <td>Doris Wilder</td>
                                       <td>Sales Assistant</td>
                                       <td>Sydney</td>
                                       <td>23</td>
                                       <td>2010/09/20</td>
                                       <td class="text-right">$85,600</td>
                                    </tr>
                                    <tr>
                                       <td>Angelica Ramos</td>
                                       <td>Chief Executive Officer (CEO)</td>
                                       <td>London</td>
                                       <td>47</td>
                                       <td>2009/10/09</td>
                                       <td class="text-right">$1,200,000</td>
                                    </tr>
                                    <tr>
                                       <td>Gavin Joyce</td>
                                       <td>Developer</td>
                                       <td>Edinburgh</td>
                                       <td>42</td>
                                       <td>2010/12/22</td>
                                       <td class="text-right">$92,575</td>
                                    </tr>
                                    <tr>
                                       <td>Jennifer Chang</td>
                                       <td>Regional Director</td>
                                       <td>Singapore</td>
                                       <td>28</td>
                                       <td>2010/11/14</td>
                                       <td class="text-right">$357,650</td>
                                    </tr>
                                    <tr>
                                       <td>Brenden Wagner</td>
                                       <td>Software Engineer</td>
                                       <td>San Francisco</td>
                                       <td>28</td>
                                       <td>2011/06/07</td>
                                       <td class="text-right">$206,850</td>
                                    </tr>
                                    <tr>
                                       <td>Fiona Green</td>
                                       <td>Chief Operating Officer (COO)</td>
                                       <td>San Francisco</td>
                                       <td>48</td>
                                       <td>2010/03/11</td>
                                       <td class="text-right">$850,000</td>
                                    </tr>
                                    <tr>
                                       <td>Shou Itou</td>
                                       <td>Regional Marketing</td>
                                       <td>Tokyo</td>
                                       <td>20</td>
                                       <td>2011/08/14</td>
                                       <td class="text-right">$163,000</td>
                                    </tr>
                                    <tr>
                                       <td>Michelle House</td>
                                       <td>Integration Specialist</td>
                                       <td>Sydney</td>
                                       <td>37</td>
                                       <td>2011/06/02</td>
                                       <td class="text-right">$95,400</td>
                                    </tr>
                                    <tr>
                                       <td>Suki Burks</td>
                                       <td>Developer</td>
                                       <td>London</td>
                                       <td>53</td>
                                       <td>2009/10/22</td>
                                       <td class="text-right">$114,500</td>
                                    </tr>
                                    <tr>
                                       <td>Prescott Bartlett</td>
                                       <td>Technical Author</td>
                                       <td>London</td>
                                       <td>27</td>
                                       <td>2011/05/07</td>
                                       <td class="text-right">$145,000</td>
                                    </tr>
                                    <tr>
                                       <td>Gavin Cortez</td>
                                       <td>Team Leader</td>
                                       <td>San Francisco</td>
                                       <td>22</td>
                                       <td>2008/10/26</td>
                                       <td class="text-right">$235,500</td>
                                    </tr>
                                    <tr>
                                       <td>Martena Mccray</td>
                                       <td>Post-Sales support</td>
                                       <td>Edinburgh</td>
                                       <td>46</td>
                                       <td>2011/03/09</td>
                                       <td class="text-right">$324,050</td>
                                    </tr>
                                    <tr>
                                       <td>Unity Butler</td>
                                       <td>Marketing Designer</td>
                                       <td>San Francisco</td>
                                       <td>47</td>
                                       <td>2009/12/09</td>
                                       <td class="text-right">$85,675</td>
                                    </tr>
                                    <tr>
                                       <td>Howard Hatfield</td>
                                       <td>Office Manager</td>
                                       <td>San Francisco</td>
                                       <td>51</td>
                                       <td>2008/12/16</td>
                                       <td class="text-right">$164,500</td>
                                    </tr>
                                    <tr>
                                       <td>Hope Fuentes</td>
                                       <td>Secretary</td>
                                       <td>San Francisco</td>
                                       <td>41</td>
                                       <td>2010/02/12</td>
                                       <td class="text-right">$109,850</td>
                                    </tr>
                                    <tr>
                                       <td>Vivian Harrell</td>
                                       <td>Financial Controller</td>
                                       <td>San Francisco</td>
                                       <td>62</td>
                                       <td>2009/02/14</td>
                                       <td class="text-right">$452,500</td>
                                    </tr>
                                    <tr>
                                       <td>Timothy Mooney</td>
                                       <td>Office Manager</td>
                                       <td>London</td>
                                       <td>37</td>
                                       <td>2008/12/11</td>
                                       <td class="text-right">$136,200</td>
                                    </tr>
                                    <tr>
                                       <td>Jackson Bradshaw</td>
                                       <td>Director</td>
                                       <td>New York</td>
                                       <td>65</td>
                                       <td>2008/09/26</td>
                                       <td class="text-right">$645,750</td>
                                    </tr>
                                    <tr>
                                       <td>Olivia Liang</td>
                                       <td>Support Engineer</td>
                                       <td>Singapore</td>
                                       <td>64</td>
                                       <td>2011/02/03</td>
                                       <td class="text-right">$234,500</td>
                                    </tr>
                                    <tr>
                                       <td>Bruno Nash</td>
                                       <td>Software Engineer</td>
                                       <td>London</td>
                                       <td>38</td>
                                       <td>2011/05/03</td>
                                       <td class="text-right">$163,500</td>
                                    </tr>
                                    <tr>
                                       <td>Sakura Yamamoto</td>
                                       <td>Support Engineer</td>
                                       <td>Tokyo</td>
                                       <td>37</td>
                                       <td>2009/08/19</td>
                                       <td class="text-right">$139,575</td>
                                    </tr>
                                    <tr>
                                       <td>Thor Walton</td>
                                       <td>Developer</td>
                                       <td>New York</td>
                                       <td>61</td>
                                       <td>2013/08/11</td>
                                       <td class="text-right">$98,540</td>
                                    </tr>
                                    <tr>
                                       <td>Finn Camacho</td>
                                       <td>Support Engineer</td>
                                       <td>San Francisco</td>
                                       <td>47</td>
                                       <td>2009/07/07</td>
                                       <td class="text-right">$87,500</td>
                                    </tr>
                                    <tr>
                                       <td>Serge Baldwin</td>
                                       <td>Data Coordinator</td>
                                       <td>Singapore</td>
                                       <td>64</td>
                                       <td>2012/04/09</td>
                                       <td class="text-right">$138,575</td>
                                    </tr>
                                    <tr>
                                       <td>Zenaida Frank</td>
                                       <td>Software Engineer</td>
                                       <td>New York</td>
                                       <td>63</td>
                                       <td>2010/01/04</td>
                                       <td class="text-right">$125,250</td>
                                    </tr>
                                    <tr>
                                       <td>Zorita Serrano</td>
                                       <td>Software Engineer</td>
                                       <td>San Francisco</td>
                                       <td>56</td>
                                       <td>2012/06/01</td>
                                       <td class="text-right">$115,000</td>
                                    </tr>
                                    <tr>
                                       <td>Jennifer Acosta</td>
                                       <td>Junior Javascript Developer</td>
                                       <td>Edinburgh</td>
                                       <td>43</td>
                                       <td>2013/02/01</td>
                                       <td class="text-right">$75,650</td>
                                    </tr>
                                    <tr>
                                       <td>Cara Stevens</td>
                                       <td>Sales Assistant</td>
                                       <td>New York</td>
                                       <td>46</td>
                                       <td>2011/12/06</td>
                                       <td class="text-right">$145,600</td>
                                    </tr>
                                    <tr>
                                       <td>Hermione Butler</td>
                                       <td>Regional Director</td>
                                       <td>London</td>
                                       <td>47</td>
                                       <td>2011/03/21</td>
                                       <td class="text-right">$356,250</td>
                                    </tr>
                                    <tr>
                                       <td>Lael Greer</td>
                                       <td>Systems Administrator</td>
                                       <td>London</td>
                                       <td>21</td>
                                       <td>2009/02/27</td>
                                       <td class="text-right">$103,500</td>
                                    </tr>
                                    <tr>
                                       <td>Jonas Alexander</td>
                                       <td>Developer</td>
                                       <td>San Francisco</td>
                                       <td>30</td>
                                       <td>2010/07/14</td>
                                       <td class="text-right">$86,500</td>
                                    </tr>
                                    <tr>
                                       <td>Shad Decker</td>
                                       <td>Regional Director</td>
                                       <td>Edinburgh</td>
                                       <td>51</td>
                                       <td>2008/11/13</td>
                                       <td class="text-right">$183,000</td>
                                    </tr>
                                    <tr>
                                       <td>Michael Bruce</td>
                                       <td>Javascript Developer</td>
                                       <td>Singapore</td>
                                       <td>29</td>
                                       <td>2011/06/27</td>
                                       <td class="text-right">$183,000</td>
                                    </tr>
                                    <tr>
                                       <td>Donna Snider</td>
                                       <td>Customer Support</td>
                                       <td>New York</td>
                                       <td>27</td>
                                       <td>2011/01/25</td>
                                       <td class="text-right">$112,000</td>
                                    </tr>
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <th>Name</th>
                                       <th>Position</th>
                                       <th>Office</th>
                                       <th>Age</th>
                                       <th>Start date</th>
                                       <th class="text-right">Salary</th>
                                    </tr>
                                 </tfoot>
                              </table> --}}
                              <table id="caseListTable" class="table table-bordered table-striped">
                                <thead class="thead-gold">
                                <tr>
                                  <th>ID</th>
                                  <th>Name</th>
                                  <th>Description</th>
                                  <th>Added Date</th>
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

         <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content modal-theme">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalCenterTitle">Hi, {{$user_details->first_name}}</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <div>
                        Do you want to avail some predefined categories by the system to help you get started?
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" id="predefined-category-no" class="btn action-btn" data-dismiss="modal">Nope!</button>
                     <button type="button" id="predefined-category-yes" class="btn theme-btn" data-dismiss="modal">Sure, why not?</button>
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
                    url:"{{route('category_management.get_list')}}",
                    type:"POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    // beforeSend: function (xhr, settings) {
                    //     xhr.setRequestHeader("X-CSRFToken", csrf_token);
                    // },
                    // data: function (data) {
                    //     return JSON.stringify(data);
                    // },
                },
                columns: [
                    { data: 'id',orderable:false,visible:false},
                    { data: 'name' }, 
                    { data: 'description', width: '30%' },
                    { data: 'added_time' },
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

    const addCategoryButton = document.getElementById('add-category-button');
    const predefinedCategoryYesButton = document.getElementById('predefined-category-yes');
    const predefinedCategoryNoButton = document.getElementById('predefined-category-no');
      predefinedCategoryYesButton.addEventListener('click', function() {
      console.log('Yes Button was clicked!');
      // You can add any additional logic here.
      window.location.href="{{route('category_management.populate_defaults')}}";
   });
      predefinedCategoryNoButton.addEventListener('click', function() {
         console.log('No Button was clicked!');
         // You can add any additional logic here.
      });

      addCategoryButton.addEventListener('click',function(){
         window.location.href="{{route('category_management.add_category')}}";
      });
        });
    </script>
</body>
</html>