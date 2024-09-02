<!DOCTYPE html>
<html lang="en">
    @include('structures.head')
    <div class="wrapper">
        @include('structures.sidebar')
        @include('structures.topbar')
      <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Add Category</h4>
                     </div>
                  <div class="header-action">
                           <i data-toggle="collapse" data-target="#form-element-1" aria-expanded="false">
                              <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                              </svg>
                           </i>
                        </div>
                  </div>
                  <div class="card-body">
                     <div class="collapse" id="form-element-1">
                        </div>
                     <form method="POST" action="{{route('category_management.create_category')}}">
                        @csrf
                        <div class="form-group">
                           <label for="name">Name:</label>
                           <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}">
                           @error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                           <label for="description">Description:</label>
                           <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" value="{{old('description')}}">
                           @error('description')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks:</label>
                             <input type="text" id="remarks" name="remarks" placeholder="Add tags here" values="">
                        </div>
                        <button type="submit" class="btn theme-btn mr-2">Submit</button>
                        <button type="submit" class="btn action-btn">Cancel</button>
                     </form>
                  </div>
               </div>
               {{-- </div> --}}
            </div>
         </div>
      </div>
      </div>
    </div>
    @include('structures.footer')
    @include('structures.footer_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const element = document.querySelector('#remarks');  // or use another selector like '#myChoice'
            
            const choices = new Choices(element, {
                addItems: true,                 // Allows adding new items
                removeItems: true,              // Allows removing items
                removeItemButton: true,         // Adds a button to remove items
                duplicateItemsAllowed: false,   // Prevents duplicates
                placeholderValue: 'Add tags here',  // Placeholder text
                searchEnabled: true,            // Enables searching through choices
                searchChoices: true,            // Allows searching within choices
                delimiter: ',',                 // Defines delimiter for multiple tags in input
                editItems: true,                // Allows editing of items
                paste: true,                    // Allows pasting to add multiple items
                noChoicesText: 'No choices to choose from', // Text when no choices available
                noResultsText: 'No results found',          // Text when search yields no results
                addItemText: (value) => {
                    return `Press Enter to add <b>"${value}"</b>`;  // Text for adding a new item
                },
            });

            const preSelectedValues = @json(old('remarks'));

            // Set pre-selected values
            choices.setValue(preSelectedValues);
        });
    </script>
</html>