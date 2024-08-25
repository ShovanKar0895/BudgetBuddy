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
                        <h4 class="card-title">Edit Investment</h4>
                     </div>
                  <div class="header-action">
                        </div>
                  </div>
                  <div class="card-body">
                     <div class="collapse" id="form-element-1">
                        </div>
                     <form method="POST" action="{{route('investments.update_investment',['investment_id' => $investment_details->id])}}">
                        @csrf
                        <div class="form-group">
                           <label for="type">Type:</label>
                            <select class="form-control @error('type') is-invalid @enderror" name="type" id="type">
                                <option selected value="">Choose...</option>
                                <option value="FD" @if($investment_details->type == 'FD') selected @endif>FD (Fixed Deposit)</option>
                                <option value="RD" @if($investment_details->type == 'RD') selected @endif>RD (Recurring Deposit)</option>
                                <option value="SIP" @if($investment_details->type == 'SIP') selected @endif>SIP (Systematic Investment Plan)</option>
                            </select>
                            @error('type')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                           <label for="amount">Amount (in Rupees):</label>
                           <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amount" value="{{$investment_details->amount}}">
                           @error('amount')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="institution">Institution:</label>
                            <input type="text" class="form-control @error('institution') is-invalid @enderror" name="institution" id="institution" value="{{$investment_details->institution}}">
                            @error('institution')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="interest_rate">Interest Rate (in %):</label>
                            <input type="text" class="form-control @error('interest_rate') is-invalid @enderror" name="interest_rate" id="interest_rate" value="{{$investment_details->interest_rate}}">
                            @error('interest_rate')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="commitment_date">Commitment Date:</label>
                            <input type="date" class="form-control @error('commitment_date') is-invalid @enderror" name="commitment_date" id="commitment_date" value="{{$investment_details->commitment_date}}">
                            @error('commitment_date')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="maturity_date">Maturity Date:</label>
                            <input type="date" class="form-control @error('maturity_date') is-invalid @enderror" name="maturity_date" id="maturity_date" value="{{$investment_details->maturity_date}}">
                            @error('maturity_date')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label for="frequency">Frequency:</label>
                             <select class="form-control @error('frequency') is-invalid @enderror" name="frequency" id="frequency">
                                 <option selected value="">Choose...</option>
                                 <option value="monthly" @if($investment_details->frequency == 'monthly') selected @endif>Monthly</option>
                                 <option value="quarterly" @if($investment_details->frequency == 'quarterly') selected @endif>Quarterly</option>
                                 <option value="half-yearly" @if($investment_details->frequency == 'half-yearly') selected @endif>Half Yearly</option>
                                 <option value="yearly" @if($investment_details->frequency == 'yearly') selected @endif>Yearly</option>
                             </select>
                             @error('frequency')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        </div>  
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select multiple class="form-control choicesjs" id="category" name="category[]">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->_id }}" 
                                        @if(in_array((string) $category->_id, (array) $investment_details->category)) selected @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="note">Note:</label>
                            <input type="text" class="form-control @error('note') is-invalid @enderror" name="note" id="note" value="{{$investment_details->note}}">
                            @error('note')<div class="alert alert-danger">{{ $message }}</div>@enderror
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
        });
    </script>
</html>