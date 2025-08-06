<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User register
        DB::table('users')
            ->insert([
                'profile' => '',
                'card_id' => '00000',
                'name_kh' => 'អ្នកអភិវឌ្ឍន៍',
                'name_en' => 'Super Developer',
                'email'   => 'developer@123',
                'password' => bcrypt('ims@123'),
                'role_id' => 1,
                'created_at' => now(),
                'create_by' => 'Developer',
                'gender' => 'Male',
                'position' => '',
                'phone_number' => '000000000',
                'email_address' => 'inventory.developer@gamil.com',
            ]);

        // Main fucntion register
            DB::table('main_function')
                ->insert([
                    'id' => 1,
                    'name' => 'Dashboard',
                    'name_kh' => 'ផ្ទាំងគ្រប់គ្រង',
                    'icon_name' => 'mdi-home',
                ]);
            DB::table('main_function')
                ->insert([
                    'id' => 2,
                    'name' => 'Master Data',
                    'name_kh' => 'ទិន្នន័យបឋម',
                    'icon_name' => 'mdi-database-outline',
                ]);
            DB::table('main_function')
                ->insert([
                    'id' => 3,
                    'name' => 'Items Management',
                    'name_kh' => 'គ្រប់គ្រងសម្ភារៈ',
                    'icon_name' => 'mdi-table',
                ]);

            DB::table('main_function')
                ->insert([
                    'id' => 4,
                    'name' => 'Given&Returned',
                    'name_kh' => 'ផ្តល់ជូន&ប្រគល់ត្រឡប់',
                    'icon_name' => 'mdi-hand-coin-outline',
                ]);

            // DB::table('main_function')
            //     ->insert([
            //         'id' => 5,
            //         'name' => 'Request borrow',
            //         'name_kh' => 'សំណើ',
            //         'icon_name' => 'mdi-inbox-arrow-down-outline',
            //     ]);
            // DB::table('main_function')
            //     ->insert([
            //         'id' => 6,
            //         'name' => 'Purchase request',
            //         'name_kh' => 'សំណើទិញ',
            //         'icon_name' => 'mdi-shopping-outline',
            //     ]);
            DB::table('main_function')
                ->insert([
                    'id' => 5,
                    'name' => 'Expense Reports',
                    'name_kh' => 'របាយការណ៍ចំណាយ',
                    'icon_name' => 'mdi-finance',
                ]);
            DB::table('main_function')
                ->insert([
                    'id' => 6,
                    'name' => 'Reports',
                    'name_kh' => 'របាយការណ៍',
                    'icon_name' => 'mdi-chart-bar',
                ]);

            DB::table('main_function')
                ->insert([
                    'id' => 7,
                    'name' => 'Manage Users',
                    'name_kh' => 'គ្រប់គ្រងអ្នកប្រើប្រាស់',
                    'icon_name' => 'mdi-account-group-outline',
                ]);
        // Register main function end



        // Register sub-function
            // sub for master
            DB::table('sub_function')
                ->insert([
                    'id' => 1,
                    'main_function_id' => '2',
                    'name' => 'Item Category',
                    'name_kh' => 'ប្រភេទសម្ភារៈ',
                    'route_name' => 'category.list',
                    'url_name' => 'category/list',
                ]);

            DB::table('sub_function')
                ->insert([
                    'id' => 2,
                    'main_function_id' => '2',
                    'name' => 'Departments',
                    'name_kh' => 'នាយកដ្ឋាន',
                    'route_name' => 'department.list',
                    'url_name' => 'department/list',
                ]);
            DB::table('sub_function')
                ->insert([
                    'id' => 3,
                    'main_function_id' => '2',
                    'name' => 'Sections',
                    'name_kh' => 'ផ្នែក',
                    'route_name' => 'section.list',
                    'url_name' => 'section/list',
                ]);
            DB::table('sub_function')
                ->insert([
                    'id' => 4,
                    'main_function_id' => '2',
                    'name' => 'Positions',
                    'name_kh' => 'មុខតំណែង/តួនាទី',
                    'route_name' => 'position.list',
                    'url_name' => 'position/list',
                ]);
            DB::table('sub_function')
                ->insert([
                    'id' => 5,
                    'main_function_id' => '2',
                    'name' => 'Staff Lists',
                    'name_kh' => 'បញ្ជីបុគ្គលិក',
                    'route_name' => 'staff.index',
                    'url_name' => 'staff',
                ]);


            // sub for item
            DB::table('sub_function')
                ->insert([
                    'id' => 6,
                    'main_function_id' => '3',
                    'name' => 'Item Stock-In',
                    'name_kh' => 'សម្ភារៈក្នុងស្តុក',
                    'route_name' => 'product.instock',
                    'url_name' => 'product/instock',
                ]);
            DB::table('sub_function')
                ->insert([
                    'id' => 7,
                    'main_function_id' => '3',
                    'name' => 'Item Stock-Out',
                    'name_kh' => 'សម្ភារៈក្រៅស្តុក',
                    'route_name' => 'product.outstock',
                    'url_name' => 'product/outstock',
                ]);
            DB::table('sub_function')
                ->insert([
                    'id' => 8,
                    'main_function_id' => '3',
                    'name' => 'Item Statistic',
                    'name_kh' => 'ស្ថិតិសម្ភារៈ',
                    'route_name' => 'product.statistic',
                    'url_name' => 'product/statistic',
                ]);

            // sub function for given&return as main_id 4
            DB::table('sub_function')
                ->insert([
                    'id' => 9,
                    'main_function_id' => '4',
                    'name' => 'Add Given Item',
                    'name_kh' => 'បន្ថែមការផ្តល់ជូនសម្ភារៈ',
                    'route_name' => 'product.addGive',
                    'url_name' => 'product/add-give',

                ]);
            DB::table('sub_function')
                ->insert([
                    'id' => 10,
                    'main_function_id' => '4',
                    'name' => 'Given List',
                    'name_kh' => 'បញ្ជីបានផ្តល់ជូន',
                    'route_name' => 'product.givenList',
                    'url_name' => 'product/given',

                ]);

            DB::table('sub_function')
                ->insert([
                    'id' => 11,
                    'main_function_id' => '4',
                    'name' => 'Returned List',
                    'name_kh' => 'បញ្ជីបានប្រគល់ត្រឡប់',
                    'route_name' => 'product.returned',
                    'url_name' => 'product/returned',

                ]);

            DB::table('sub_function')
                ->insert([
                    'id' => 12,
                    'main_function_id' => '4',
                    'name' => 'Returned (Old item)',
                    'name_kh' => 'ប្រគល់ត្រឡប់ (សម្ភារៈចាស់)',
                    'route_name' => 'returnOutList.index',
                    'url_name' => 'returned/item/out-list',

                ]);


            DB::table('sub_function')
                ->insert([
                    'id' => 13,
                    'main_function_id' => '5',
                    'name' => 'ITE Purchase',
                    'name_kh' => 'ចំណាយទិញសម្ភារៈ',
                    'route_name' => 'expense.purchase.index',
                    'url_name' => 'expense/purchase',

                ]);

            DB::table('sub_function')
                ->insert([
                    'id' => 14,
                    'main_function_id' => '5',
                    'name' => 'Service Fee',
                    'name_kh' => 'ចំណាយថ្លៃសេវាកម្ម',
                    'route_name' => 'expense.service.index',
                    'url_name' => 'expense/service/fee',

                ]);

            DB::table('sub_function')
                ->insert([
                    'id' => 15,
                    'main_function_id' => '2',
                    'name' => 'Item Code',
                    'name_kh' => 'លេខកូដសម្ភារៈ',
                    'route_name' => 'item_code.index',
                    'url_name' => 'item/code',
                ]);

            DB::table('sub_function')
                ->insert([
                    'id' => 16,
                    'main_function_id' => '3',
                    'name' => 'Trashbin',
                    'name_kh' => 'ធុងសម្រាម',
                    'route_name' => 'product.trashbin',
                    'url_name' => 'product/item/trash',
                ]);

            //user role register
            // DB::table('user_roles')
            //     ->insert([
            //         'id' => 1,
            //         'role_name' => 'Super Admin',
            //         'add_by' => 'Developer',
            //     ]);


            DB::table('user_roles')
                ->insert([
                    'id' => 1,
                    'role_name' => 'Admin',
                    'add_by' => 'Developer',
                ]);



            // DB::table('sub_function')
            //     ->insert([
            //         'main_function_id' => '7',
            //         'name' => 'Super Admin',
            //         'name_kh' => '',
            //         'route_name' => 'user/1/Super Admin',
            //         'url_name' => 'user/{role}/{name}',
            //     ]);

            DB::table('sub_function')
                ->insert([
                    'main_function_id' => '7',
                    'name' => 'Admin',
                    'name_kh' => '',
                    'route_name' => 'user/1/Admin',
                    'url_name' => 'user/{role}/{name}',
                ]);


    }
}
