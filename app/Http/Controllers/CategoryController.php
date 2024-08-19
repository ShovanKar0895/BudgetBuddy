<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    private CategoryService $categoryService;
 
    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }

    public function listSection(Request $request){

        $user = Auth::user();
        $user->full_name = $user->first_name.' '.$user->last_name;

        $viewData = [
            'section' => 'Category Management',
            'user_details' => $user,
        ];
        return view('client.category_list',$viewData);
    }

    public function getCategoriesList(Request $request){
        // echo "<pre>";echo "<b>Total Response with ajax : </b>";dump($request->post());echo "</pre>";echo "<br><br>";

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
                $columnName = 'name';
                break;
            case '2':
                $columnName = 'description';
                break;
            case '3':
                $columnName = 'added_time';
                break;
            case '4':
                $columnName = 'status';
                break;
            default:
                $columnName = 'added_time';
                $columnSortOrder = 'desc';
        }

        if($draw === '1'){
            $columnName = 'added_time';
            $columnSortOrder = 'desc';
        }else{
        }

        $fetchListCountConditions = [
            'search_by' => $searchValue,
        ];
        // $totalUserCount = User::fetchAllUsersCount($fetchListCountConditions);
        $totalUserCount = $this->categoryService->count();
        //  echo "<pre>";echo "<b>Total Users : </b>";dump($totalUserCount);echo "</pre>";echo "<br><br>";
        //  die();

        $fetchListConditions = [
            'search_by' => $searchValue,
            'ordering_column' => $columnName,
            'ordering_column_by' => $columnSortOrder,
            'limit' => $rowPerPage,
            'offset' => $row, 
        ];
        // $fetchedUserList = User::fetchUsersList($fetchListConditions);
        $fetchedUserList = $this->categoryService->list($fetchListConditions);
        // echo "<pre>";echo "<b>Fetched Users : </b>";dump($fetchedUserList);echo "</pre>";echo "<br><br>";

        $usersListTempHolder = [];
        if($fetchedUserList->count()>0){
            foreach($fetchedUserList as $userKey => $userDetails){

                array_push($usersListTempHolder,[
                    'id' => $userDetails->_id,
                    'name' => $userDetails->name,
                    'description' => $userDetails->description,
                    'added_time' => $userDetails->added_time,
                    'status' => $userDetails->status,
                    'urls' => [
                        'activation_url' => route('category_management.activate_category',['category_id'=> $userDetails->id]),
                        'deactivation_url' => route('category_management.deactivate_category',['category_id'=> $userDetails->id]),
                        'deletion_url' => route('category_management.delete_category',['category_id'=> $userDetails->id]),
                    ],
                ]);
            }

            $response = [
                'draw' => $draw,
                'iTotalDisplayRecords' => $totalUserCount,
                'iTotalRecords' => count($usersListTempHolder),
                'aaData' => $usersListTempHolder,
            ];
        }else{
            $response = [
                'draw' => $draw,
                'iTotalDisplayRecords' => $totalUserCount,
                'iTotalRecords' => count([]),
                'aaData' => [],
            ];
        }
        echo json_encode($response);
    }

    public function activateCategory(Request $request){

        $encryptedUserId = $request->route('category_id');
        // dd($encryptedUserId);
        // $userId = Crypt::decryptString($encryptedUserId);

        $updateData = [
            'status' => '1',
        ];

        $affectedCategories = $this->categoryService->update($updateData,$encryptedUserId);

        $request->session()->flash('success','Category details successfully deactivated!');
        return redirect()->route('category_management.list');
    }

    public function deactivateCategory(Request $request){

        $encryptedUserId = $request->route('category_id');
        // dd($encryptedUserId);
        // $userId = Crypt::decryptString($encryptedUserId);

        $updateData = [
            'status' => '0',
        ];

        $affectedCategories = $this->categoryService->update($updateData,$encryptedUserId);

        $request->session()->flash('success','Category details successfully deactivated!');
        return redirect()->route('category_management.list');
    }

    public function deleteCategory(Request $request){

        $encryptedUserId = $request->route('category_id');
        // dd($encryptedUserId);
        // $userId = Crypt::decryptString($encryptedUserId);

        $updateData = [
            'status' => '5',
        ];

        $affectedCategories = $this->categoryService->update($updateData,$encryptedUserId);

        $request->session()->flash('success','Category details successfully deleted!');
        return redirect()->route('category_management.list');
    }
}
