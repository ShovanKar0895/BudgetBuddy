<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\AddInvestmentRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use App\Services\InvestmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class InvestmentController extends Controller
{
    private InvestmentService $investmentService;
    private CategoryService $categoryService;
 
    public function __construct(InvestmentService $investmentService,CategoryService $categoryService){
        $this->investmentService = $investmentService;
        $this->categoryService = $categoryService;
    }

    public function populateDefaultCategories(Request $request){

        $userId = Auth::id();
        $this->investmentService->populate_defaults_for_user($userId);
    }

    public function listSection(Request $request){

        $user = Auth::user();
        $user->full_name = $user->first_name.' '.$user->last_name;

        $viewData = [
            'section' => 'Investments',
            'user_details' => $user,
        ];
        return view('client.investment.list',$viewData);
    }

    public function addInvestmentSection(Request $request){

        $user = Auth::user();
        $user->full_name = $user->first_name.' '.$user->last_name;

        // $categories = $this->categoryService->fetch_all();
        $subCategories = $this->categoryService->fetch_all_subcategories();
        // dd($subCategories);

        $viewData = [
            'section' => 'Investments',
            'user_details' => $user,
            'categories' => $subCategories,
        ];

        return view('client.investment.add',$viewData);
    }

    public function createInvestmentDetails(AddInvestmentRequest $request){
        
        $userId = Auth::id();

        $validatedData = $request->validated();
        // dd($validatedData);

        $categoryObjectIds = array_map(function($categoryValue){
            $categoryValueArr = explode("___",$categoryValue);
            return [
                'category_id' => new ObjectId($categoryValueArr[1]),
                'tag' => $categoryValueArr[0],
            ];
        }, $validatedData['category']);
        $validatedData['category'] = $categoryObjectIds;

        $affectedUsers = $this->investmentService->store($validatedData);
        
        $request->session()->flash('success', 'Investment details succesfully added!');
        return redirect()->route('investments.list');
    }

    public function getInvestmentsListForUser(Request $request){
        // echo "<pre>";echo "<b>Total Response with ajax : </b>";dump($request->post());echo "</pre>";echo "<br><br>";

        $userId = new ObjectId(Auth::id());

        $draw = $request->post('draw');
        $row = $request->post('start');
        $rowPerPage = $request->post('length');

        $columnIndexArr = $request->post('order');
        $columnIndex = $columnIndexArr[0]['column'];

        $columnNameArr = $request->post('columns');
        $columnName = $columnNameArr[$columnIndex]['data'];

        $columnSortOrderArr = $request->post('order');
        $columnSortOrder = $columnSortOrderArr[0]['dir'];

        $searchValueArr = $request->post('search');
        $searchValue = $searchValueArr['value']!='' ? $searchValueArr['value'] : '';

        // echo "<b>Draw</b> : ";dump($draw);echo "<br><br>";
        // echo "<b>Row : </b>";dump($row);echo "<br><br>";
        // echo "<b>Row per page : </b>";dump($rowPerPage);echo "<br><br>";
        // echo "<b>Column Index : </b>";dump($columnIndex);echo "<br><br>";
        // echo "<b>Column Name : </b>";dump($columnName);echo "<br><br>";
        // echo "<b>Column Sort Order : </b>";dump($columnSortOrder);echo "<br><br>";
        // echo "<b>Search value : </b>";dump($searchValue);echo "<br><br>";
        // die();

        switch ($columnIndex){
            case '1':
                $columnName = 'type';
                break;
            case '2':
                $columnName = 'amount';
                break;
            case '3':
                $columnName = 'institution';
                break;
            case '4':
                $columnName = 'maturity_date';
                break;
            case '5':
                $columnName = 'commitment_date';
                break;
            case '6':
                $columnName = 'category';
                break;
            case '7':
                $columnName = 'note';
                break;
            default:
                $columnName = 'maturity_date';
                $columnSortOrder = 'asc';
        }

        if($draw === '1'){
            $columnName = 'maturity_date';
            $columnSortOrder = 'asc';
        }else{
        }

        $fetchListCountConditions = [
            'user_id' => $userId,
            'search_by' => $searchValue,
        ];
        // $totalUserCount = User::fetchAllUsersCount($fetchListCountConditions);
        $totalInvestmentsCount = $this->investmentService->count($fetchListCountConditions);
        //  echo "<pre>";echo "<b>Total Users : </b>";dump($totalInvestmentsCount);echo "</pre>";echo "<br><br>";
        //  die();

        $fetchListConditions = [
            'user_id' => $userId,
            'search_by' => $searchValue,
            'ordering_column' => $columnName,
            'ordering_column_by' => $columnSortOrder,
            'limit' => $rowPerPage,
            'offset' => $row, 
        ];
        // $fetchedUserList = User::fetchUsersList($fetchListConditions);
        $fetchedInvestmentsList = $this->investmentService->list($fetchListConditions);
        // echo "<pre>";echo "<b>Fetched Users : </b>";dump($fetchedInvestmentsList);echo "</pre>";echo "<br><br>";

        $usersListTempHolder = [];
        if($fetchedInvestmentsList->count()>0){
            foreach($fetchedInvestmentsList as $investmentKey => $investmentDetails){

                // $categoryDetails = $this->categoryService->fetch($investmentDetails->category[$investmentKey]);
                $categoryDetailsArr = [];
                array_push($usersListTempHolder,[
                    'id' => $investmentDetails->_id,
                    'type' => $investmentDetails->type,
                    'amount' => $investmentDetails->amount,
                    'institution' => $investmentDetails->institution,
                    'maturity_date' => $investmentDetails->maturity_date->toDateTime()->format('d M, Y'),
                    'commitment_date' => $investmentDetails->commitment_date->toDateTime()->format('d M, Y'),
                    'category' => $investmentDetails->category,
                    'note' => $investmentDetails->note,
                    'status' => $investmentDetails->status,
                    'urls' => [
                        'activation_url' => route('investments.activate_investment',['investment_id'=> $investmentDetails->id]),
                        'deactivation_url' => route('investments.deactivate_investment',['investment_id'=> $investmentDetails->id]),
                        'edit_url' => route('investments.edit_investment',['investment_id' => $investmentDetails->id]),
                        'deletion_url' => route('investments.delete_investment',['investment_id'=> $investmentDetails->id]),
                    ],
                    // 'urls' => [
                    //     'activation_url' => '#',
                    //     'deactivation_url' => '#',
                    //     'edit_url' => '#',
                    //     'deletion_url' => '#',
                    // ],
                ]);
            }

            $response = [
                'draw' => $draw,
                'iTotalDisplayRecords' => $totalInvestmentsCount,
                'iTotalRecords' => count($usersListTempHolder),
                'aaData' => $usersListTempHolder,
            ];
        }else{
            $response = [
                'draw' => $draw,
                'iTotalDisplayRecords' => $totalInvestmentsCount,
                'iTotalRecords' => count([]),
                'aaData' => [],
            ];
        }
        echo json_encode($response);
    }

    public function activateInvestment(Request $request){

        $encryptedUserId = $request->route('investment_id');
        // dd($encryptedUserId);
        // $userId = Crypt::decryptString($encryptedUserId);

        $updateData = [
            'status' => '1',
        ];

        $affectedCategories = $this->investmentService->update($updateData,$encryptedUserId);

        $request->session()->flash('success','Investment details successfully deactivated!');
        return redirect()->route('investments.list');
    }

    public function deactivateInvestment(Request $request){

        $encryptedUserId = $request->route('investment_id');
        // dd($encryptedUserId);
        // $userId = Crypt::decryptString($encryptedUserId);

        $updateData = [
            'status' => '0',
        ];

        $affectedCategories = $this->investmentService->update($updateData,$encryptedUserId);

        $request->session()->flash('success','Investment details successfully deactivated!');
        return redirect()->route('investments.list');
    }

    public function deleteInvestment(Request $request){

        $encryptedUserId = $request->route('investment_id');
        // dd($encryptedUserId);
        // $userId = Crypt::decryptString($encryptedUserId);

        $updateData = [
            'status' => '5',
        ];

        $affectedCategories = $this->investmentService->update($updateData,$encryptedUserId);

        $request->session()->flash('success','Investment details successfully deleted!');
        return redirect()->route('investments.list');
    }

    public function editInvestmentSection(Request $request){

        $investmentId = $request->route('investment_id');
        $user = Auth::user();
        $user->full_name = $user->first_name.' '.$user->last_name;

        $investment = $this->investmentService->fetch($investmentId);
        $investment->maturity_date = $investment->maturity_date->toDateTime()->format('Y-m-d');
        $investment->commitment_date = $investment->commitment_date->toDateTime()->format('Y-m-d');

        $subCategoryNames = array_map(function($value){
            return $value['tag'];
        }, $investment->category);
        $investment->category = $subCategoryNames;

        $categories = $this->categoryService->fetch_all();
        // dd($categories);

        $viewData = [
            'section' => 'Investment Management',
            'user_details' => $user,
            'investment_details' => $investment,
            'categories' => $categories
        ];

        // dd($viewData);


        return view('client.investment.edit',$viewData);
    }

    public function updateInvestmentDetails(AddInvestmentRequest $request){
        
        $userId = Auth::id();
        $investmentId = $request->route('investment_id');

        $validatedData = $request->validated();
        $validatedData['maturity_date'] = new UTCDateTime(strtotime($validatedData['maturity_date'])*1000);
        $validatedData['commitment_date'] = new UTCDateTime(strtotime($validatedData['commitment_date'])*1000);
        $categoryObjectIds = array_map(function($categoryValue){
            $categoryValueArr = explode("___",$categoryValue);
            return [
                'category_id' => new ObjectId($categoryValueArr[1]),
                'tag' => $categoryValueArr[0],
            ];
        }, $validatedData['category']);
        $validatedData['category'] = $categoryObjectIds;
        // dd($validatedData);

        $affectedUsers = $this->investmentService->update($validatedData,$investmentId);
        
        $request->session()->flash('success', 'Category details succesfully updated!');
        return redirect()->route('investments.list');
    }

    
}
