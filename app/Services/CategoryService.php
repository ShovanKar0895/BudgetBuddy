<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class CategoryService
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function categoryDocument(array $userData){

        return [
            'name' => $userData['name'] ?? null,
            'description' => $userData['description'] ?? null,
            'remarks' => $userData['remarks'] ?? null,
            'user_id' => new ObjectId(Auth::id()),
            'added_time' => new UTCDateTime(time()*1000),
            'last_updated_time' => $userData['last_updated_time'] ?? null,
            'status' => '1',
        ];
    }

    public function populate_system_defaults(){

        $systemDefaultCategories = [
            [
                "name" => "Income",
                "description" => "Funds received from various sources like salary, bonuses, and investments.",
                "remarks" => ["Salary", "Bonuses", "Freelance Work"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Rent",
                "description" => "Monthly payments for housing, such as rent or mortgage.",
                "remarks" => ["Monthly Rent", "Mortgage", "Property Tax"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Utilities",
                "description" => "Recurring bills for services like electricity, water, and internet.",
                "remarks" => ["Electricity", "Water", "Internet"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Groceries",
                "description" => "Expenses for food and household supplies.",
                "remarks" => ["Supermarket", "Groceries", "Household Items"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Transportation",
                "description" => "Costs related to travel, such as fuel and public transportation.",
                "remarks" => ["Fuel", "Public Transport", "Vehicle Maintenance"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Insurance",
                "description" => "Premiums for insurance coverage, including health and vehicle.",
                "remarks" => ["Health Insurance", "Car Insurance", "Life Insurance"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Healthcare",
                "description" => "Medical expenses, including doctor visits and medications.",
                "remarks" => ["Doctor Visits", "Medications", "Medical Tests"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Dining Out",
                "description" => "Spending on meals at restaurants or takeout.",
                "remarks" => ["Restaurants", "Fast Food", "Takeaway"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Entertainment",
                "description" => "Leisure activities like movies, games, and hobbies.",
                "remarks" => ["Movies", "Concerts", "Hobbies"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Travel",
                "description" => "Expenses for trips and vacations, including flights and accommodations.",
                "remarks" => ["Flights", "Hotels", "Vacation Packages"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Clothing",
                "description" => "Purchases of apparel, shoes, and accessories.",
                "remarks" => ["Clothes", "Shoes", "Accessories"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Personal Care",
                "description" => "Spending on grooming and beauty products.",
                "remarks" => ["Haircuts", "Skincare", "Cosmetics"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Education",
                "description" => "Costs related to schooling and learning, including tuition and books.",
                "remarks" => ["Tuition", "Books", "Courses"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Subscriptions",
                "description" => "Recurring fees for services like streaming, magazines, and software.",
                "remarks" => ["Streaming Services", "Magazines", "Software"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Debt Repayment",
                "description" => "Payments towards loans and credit card balances.",
                "remarks" => ["Credit Card Payments", "Loan Payments", "Mortgage Payments"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Savings",
                "description" => "Funds set aside for savings goals, such as emergency funds or retirement.",
                "remarks" => ["Emergency Fund", "Retirement", "Savings Account"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Investments",
                "description" => "Money allocated to stocks, bonds, or other investment vehicles.",
                "remarks" => ["Stocks", "Bonds", "Mutual Funds"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Gifts",
                "description" => "Spending on gifts for family and friends for various occasions.",
                "remarks" => ["Birthday Gifts", "Holiday Gifts", "Wedding Gifts"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Pets",
                "description" => "Expenses for pet care, including food, vet visits, and grooming.",
                "remarks" => ["Pet Food", "Vet Visits", "Pet Grooming"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Household Items",
                "description" => "Purchases for home needs like furniture, decor, and cleaning supplies.",
                "remarks" => ["Furniture", "Cleaning Supplies", "Decor"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Miscellaneous",
                "description" => "Expenses that don’t fit into specific categories.",
                "remarks" => ["Unplanned Expenses", "One-time Purchases", "Unexpected Costs"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Fitness",
                "description" => "Spending on health and fitness, including gym memberships and equipment.",
                "remarks" => ["Gym Memberships", "Sports Equipment", "Fitness Classes"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Charitable Giving",
                "description" => "Contributions to charities and non-profit organizations.",
                "remarks" => ["Donations", "Sponsorships", "Community Service"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Home Maintenance",
                "description" => "Costs for maintaining and repairing your home.",
                "remarks" => ["Repairs", "Renovations", "Maintenance Services"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Subscriptions",
                "description" => "Recurring costs for services such as newspapers, magazines, and streaming services.",
                "remarks" => ["Streaming Services", "Magazine Subscriptions", "Newspapers"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Childcare",
                "description" => "Costs associated with caring for children, including daycare and schooling.",
                "remarks" => ["Daycare", "School Supplies", "Tutoring"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Technology",
                "description" => "Spending on gadgets and tech-related services.",
                "remarks" => ["Smartphones", "Laptops", "Software"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Hobbies",
                "description" => "Expenses related to hobbies and personal interests.",
                "remarks" => ["Craft Supplies", "Books", "Music Instruments"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Loans",
                "description" => "Repayments for personal loans, including interest and principal.",
                "remarks" => ["Loan Principal", "Loan Interest", "Monthly Payments"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Taxes",
                "description" => "Payments related to taxes, including income tax, property tax, and sales tax.",
                "remarks" => ["Income Tax", "Property Tax", "Sales Tax"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
            [
                "name" => "Emergency Fund",
                "description" => "Money set aside for emergency situations.",
                "remarks" => ["Savings Account", "Liquid Assets", "Emergency Preparedness"],
                "user_id" => 0,
                "added_time" => new UTCDateTime(time()*1000),
                "last_updated_time" => null,
                "status" => "1"
            ],
        ];

        Category::insert($systemDefaultCategories);
    }

    public function populate_defaults_for_user($userId){
        try {
            // Fetch default categories
            $defaultCategories = Category::where([
                ['status', '1'],
                ['user_id', 0],
            ])->get();

            // Convert userId to MongoDB ObjectId
            $objUserId = new ObjectId($userId);

            // Transform default categories
            $multiplied = $defaultCategories->map(function ($item) use ($objUserId) {
                $itemArray = $item->toArray();
                unset($itemArray['_id']); // Remove the _id field
                $itemArray['user_id'] = $objUserId;
                $itemArray['added_time'] = new UTCDateTime(time()*1000);
                $itemArray['last_updated_time'] = null;

                return $itemArray;
            });

            // Insert new categories
            Category::insert($multiplied->toArray());

            // Update user service
            $this->userService->update([
                'category_seen' => '1'
            ], $userId);

        } catch (\Exception $e) {
            Log::error('Error in populate_defaults_for_user: ' . $e->getMessage());
            throw $e; // Optionally rethrow the exception
        }
    }


    public function count($conditions): int
    {
        $searchTerm = $conditions['search_by'];

        return Category::where([
            ['status', '!=', '5'],
            ['user_id',$conditions['user_id']]
            ])->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->count();
    }

    public function list(array $conditions): Collection
    {
        $searchTerm = $conditions['search_by'];

        return Category::where([
            ['status', '!=', '5'],
            ['user_id',$conditions['user_id']]
            ])->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('description', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy($conditions['ordering_column'], $conditions['ordering_column_by'])
            ->offset($conditions['offset'])
            ->limit($conditions['limit'])
            ->get();
    }

    public function update(array $updateData, $categoryId): int
    {
        $updateData['last_updated_time'] = new UTCDateTime(time()*1000);
        
        // Ensure $categoryId is an ObjectId if necessary
        if (!$categoryId instanceof ObjectId) {
            $categoryId = new ObjectId($categoryId);
        }

        $affectedUsers = Category::where('_id', $categoryId)
            ->where('status', '!=', '5')
            ->update($updateData);

        return $affectedUsers;
    }

    public function store(array $categoryData): Category{
        $category = Category::create($this->categoryDocument($categoryData));
        return $category;
    }

    public function fetch($categoryId){
        return Category::where([
            ['status','!=','5'],
            ['_id',$categoryId]
        ])->first();
    }

    public function fetch_all(){
        return Category::where([
            ['status','!=','5'],
            ['user_id',new ObjectId(Auth::id())],
        ])->get();
    }

    public function fetch_all_subcategories(){
        return Category::where([
            ['status','!=','5'],
            ['remarks','!=',null],
            ['user_id',new ObjectId(Auth::id())],
        ])->get()->pluck('remarks','_id');
    }
}

