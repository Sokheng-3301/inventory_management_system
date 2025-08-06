<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BorrwController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpensereportController;
use App\Http\Controllers\ExportdataController;
use App\Http\Controllers\GivenItemController;
use App\Http\Controllers\GivenReportController;
use App\Http\Controllers\InventorylistController;
use App\Http\Controllers\ItemCodeController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ManageuserController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PermissionContoller;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaserequestController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ReturnedReportController;
use App\Http\Controllers\ReturnOutlistController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ServiceFeeController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
// use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\RequestContext;

// session('ADMIN', 'Admin');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/localization/{locale}', [LocalizationController::class, 'language'])->name('localization');

Route::group(['middleware' => ['guest', 'localization']], function () {

    Route::get('login', function () {
        return view('login');
    })->name('login');
    Route::post('login/save', [UserController::class, 'login'])->name('login.save');

});
Route::middleware(['localization', 'isAuthenticated'])->group(function(){
    Route::get('screen/locked', [AccountController::class, 'locked'])->name('screen.locked');
    Route::post('screen/unlock', [AccountController::class, 'unlock'])->name('screen.unlock');

});



Route::group(['middleware' => ['isAuthenticated']], function () {
    // Route::get('/{local}', [categoryController::class, 'welcome']) -> name('/');
    // Route::get('en/', [categoryController::class, 'welcome']) -> name('en');
    // Route::get('/kh/', function (){ return redirect()->route('/');});
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});

Route::middleware(['isAuthenticated', 'localization', 'checkPermission', 'lockScreen'])
    ->group(function () {
        Route::get('screen/set/locked', [AccountController::class, 'setLocked'])->name('screen.setLocked');

        Route::get('/', [DashboardController::class, 'index'])->name('/');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('/');
        Route::get('home', [DashboardController::class, 'index'])->name('/');
        Route::get('index', [DashboardController::class, 'index'])->name('/');

        Route::get('home/getClickSidebar', [DashboardController::class, 'getClickSidebar'])->name('getClickSidebar');

        //    Route::get("/{local}", [categoryController::class, 'welcome']) -> name('/');


        //    Route::get('logout',[UserController::class, 'logout'])->name('logout');

        Route::get('/category/list', [categoryController::class, 'index'])->name('category.list');
        Route::post('category/add', [categoryController::class, 'create'])->name('category.add');
        Route::post('category/update', [categoryController::class, 'update'])->name('category.update');
        Route::post('category/delete', [categoryController::class, 'delete'])->name('category.delete');
        Route::post('category/recovery', [categoryController::class, 'recovery'])->name('category.recovery');
        Route::get('category/export/excel', [categoryController::class, 'export'])->name('category.export');
        Route::get('category/export/pdf', [categoryController::class, 'exportPdf'])->name('category.exportPdf');

        //item code
        Route::resource('item/code', ItemCodeController::class)->names('item_code');
        Route::post('item/code/delete/{id}', [ItemCodeController::class, 'delete'])->name('item_code.delete');
        Route::get('item/code/export/excel', [ItemCodeController::class, 'exportExcel'])->name('item_code.exportExcel');
        Route::get('item/code/export/pdf', [ItemCodeController::class, 'exportPdf'])->name('item_code.exportPdf');


        // department route
        Route::get('department/list', [DepartmentController::class, 'index'])->name('department.list');
        Route::post('department/add', [DepartmentController::class, 'create'])->name('department.add');
        Route::get('department/get/data/{id}', [DepartmentController::class, 'getData'])->name('department.getData');

        Route::post('department/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
        Route::post('department/delete', [DepartmentController::class, 'delete'])->name('department.delete');
        Route::post('department/recovery', [DepartmentController::class, 'recovery'])->name('department.recovery');
        Route::get('department/export/excel', [DepartmentController::class, 'export'])->name('department.export');
        Route::get('department/export/pdf', [DepartmentController::class, 'exportPdf'])->name('department.exportPdf');


        Route::get('section/list', [SectionController::class, 'index'])->name('section.list');
        Route::get('section/{id}/edit', [SectionController::class, 'edit'])->name('section.edit');
        Route::post('section/add', [SectionController::class, 'create'])->name('section.add');
        Route::post('section/update', [SectionController::class, 'update'])->name('section.update');
        Route::post('section/delete', [SectionController::class, 'delete'])->name('section.delete');
        Route::post('section/recovery', [SectionController::class, 'recovery'])->name('section.recovery');
        Route::get('section/export/excel', [SectionController::class, 'export'])->name('section.export');
        Route::get('section/export/pdf', [SectionController::class, 'exportPdf'])->name('section.exportPdf');



        Route::get('position/list', [PositionController::class, 'index'])->name('position.list');
        Route::get('position/{id}/edit', [PositionController::class, 'edit'])->name('position.edit');
        Route::post('position/add', [PositionController::class, 'create'])->name('position.add');
        Route::post('position/update', [PositionController::class, 'update'])->name('position.update');
        Route::post('position/delete', [PositionController::class, 'delete'])->name('position.delete');
        Route::post('position/recovery', [PositionController::class, 'recovery'])->name('position.recovery');
        Route::get('position/export/excel', [PositionController::class, 'export'])->name('position.export');
        Route::get('position/export/pdf', [PositionController::class, 'exportPdf'])->name('position.exportPdf');


        //    Route::get('product/list', [ProductController::class, 'index']) -> name('product.list');
        Route::get('product/instock', [ProductController::class, 'instock'])->name('product.instock');
        Route::get('product/outstock', [ProductController::class, 'outstock'])->name('product.outstock');

        Route::get('product/add', [ProductController::class, 'showForm'])->name('product.form');


        Route::post('product/add/save', [ProductController::class, 'save'])->name('product.save');
        Route::get('product/get/data/{id}', [ProductController::class, 'getData'])->name('product.getData');

        Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('product/edit/{id}/save', [ProductController::class, 'doEdit'])->name('product.editSave');
        Route::post('product/delete', [ProductController::class, 'delete'])->name('product.delete');
        Route::post('product/recovery', [ProductController::class, 'recovery'])->name('product.recovery');
        Route::post('product/{id}/detail', [ProductController::class, 'show'])->name('product.show');
        Route::get('product/statistic', [ProductController::class, 'statistic'])->name('product.statistic');

        Route::get('product/item/trash', [ProductController::class, 'trashbin'])->name('product.trashbin');
        Route::get('product/item/trash/export/excel', [ProductController::class, 'exportTrashbinExcel'])->name('product.exportTrashbinExcel');
        Route::get('product/item/trash/export/pdf', [ProductController::class, 'exportTrashbinPdf'])->name('product.exportTrashbinPdf');

        Route::get('product/eidt/fac/{id}', [ProductController::class, 'editFac'])->name('product.editFac');
        Route::post('product/eidt/fac/{id}/save', [ProductController::class, 'updateFac'])->name('product.updateFac');

        Route::get('product/{id}/detail', [ProductController::class, 'show'])->name('product.show');
        Route::get('product/{id}/detail/outstock', [ProductController::class, 'showOutstock'])->name('product.showOutstock');

        Route::get('product/{id}/destory', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('product/instock/export/excel', [ProductController::class, 'exportInstock'])->name('product.exportInstock');
        Route::get('product/instock/export/pdf', [ProductController::class, 'exportInstockPdf'])->name('product.exportInstockPdf');

        Route::get('product/outstock/export/excel', [ProductController::class, 'exportOutstock'])->name('product.exportOutstock');
        Route::get('product/outstock/export/pdf', [ProductController::class, 'exportOutstockPdf'])->name('product.exportOutstockPdf');
        Route::get('product/statistic/export/excel', [ProductController::class, 'exportStatistic'])->name('product.exportStatistic');
        Route::get('product/statistic/export/pdf', [ProductController::class, 'exportStatisticPdf'])->name('product.exportStatisticPdf');


        // Give product lists
        Route::get('product/given', [GivenItemController::class, 'givenList'])->name('product.givenList');
        Route::get('product/given/export', [GivenItemController::class, 'givenListExport'])->name('product.givenListExport');
        Route::get('product/given/{id}/detail', [GivenItemController::class, 'givenDetail'])->name('product.givenDetail');
        Route::get('product/given/list/export', [GivenItemController::class, 'givenExport'])->name('product.givenExport');
        Route::get('product/given/list/pdf', [GivenItemController::class, 'exportPdf'])->name('productGiven.pdf');
        Route::get('product/add-give', [GivenItemController::class, 'addGive'])->name('product.addGive');
        Route::get('product/add-give/{id}/edit', [GivenItemController::class, 'addGiveEdit'])->name('product.addGive.edit');
        Route::post('product/add-give/{id}/doEdit', [GivenItemController::class, 'doEditGiven'])->name('product.doEditGiven');
        Route::get('given/search', [GivenItemController::class, 'givenSearch'])->name('given.search');
        Route::post('product/give', [GivenItemController::class, 'give'])->name('product.given');



        Route::get('product/return/{id}/detail', [ProductController::class, 'returnDetail'])->name('product.returnDetail');
        Route::get('product/returned', [ProductController::class, 'returned'])->name('product.returned');
        Route::post('product/returned-product', [ProductController::class, 'doReturn'])->name('product.doReturn');
        Route::get('product/returned/{id}/detail', [ProductController::class, 'returnedDetail'])->name('product.returnedDetail');
        Route::get('product/returned/export/excel/list', [ProductController::class, 'hasReturnedExportExcel'])->name('product.hasReturnedExportExcel');
        Route::get('product/returned/export/pdf/list', [ProductController::class, 'hasReturnedExportPdf'])->name('product.hasReturnedExportPdf');




        Route::get('product/borrwing', [BorrwController::class, 'index'])->name('product.borrow');
        Route::post('product/return', [BorrwController::class, 'return'])->name('product.return');



        // Role controller
        Route::get('role/list', [RoleController::class, 'index'])->name('role.list');
        Route::post('role/add', [RoleController::class, 'save'])->name('role.save');
        Route::post('role/edit', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('role/delete', [RoleController::class, 'delete'])->name('role.delete');
        Route::post('role/recovery', [RoleController::class, 'recovery'])->name('role.recovery');



        // user
        Route::get('user/{role}/{name}', [ManageuserController::class, 'index'])->name('user.role');
        Route::post('user/block', [ManageuserController::class, 'block'])->name('user.block');
        Route::post('user/unblock', [ManageuserController::class, 'unblock'])->name('user.unblock');
        Route::post('user/reset', [ManageuserController::class, 'resetPass'])->name('user.reset');

        Route::get('user/{id}/{name}/add', [ManageuserController::class, 'add'])->name('user.add');
        Route::post('user/save', [ManageuserController::class, 'save'])->name('user.save');
        Route::get('user/{role}/{id}/edit', [ManageuserController::class, 'editForm'])->name('user.edit');
        Route::post('user/doEdit', [ManageuserController::class, 'doEdit'])->name('user.doEdit');
        Route::get('user/{role}/detail/q/{id}', [ManageuserController::class, 'show'])->name('user.show');

        //Staff Route:
        // Route::get('staff/list', [StaffController::class,'index'])->name('staff.index');
        // Route::get('staff/create', [StaffController::class,'create'])->name('staff.create');
        Route::resource('staff', StaffController::class)->names('staff');
        Route::get('staff/list/export/excel', [StaffController::class, 'export'])->name('staff.export');
        Route::get('staff/list/export/pdf', [StaffController::class, 'exportPdf'])->name('staff.exportPdf');




        // Requestsr
        Route::get('request/new', [RequestController::class, 'index'])->name('request.index');
        Route::post('request/save', [RequestController::class, 'save'])->name('request.save');
        Route::post('request/accept', [RequestController::class, 'accept'])->name('request.accept');
        Route::get('request/accepted', [RequestController::class, 'accepted'])->name('request.accepted');
        Route::post('request/reject', [RequestController::class, 'reject'])->name('request.reject');
        Route::get('request/rejected', [RequestController::class, 'rejected'])->name('request.rejected');
        Route::get('request/history', [RequestController::class, 'history'])->name('request.history');

        Route::get('request/return', [BorrwController::class, 'viewReturn'])->name('product.viewReturn');
        Route::get('request/overdraft', [BorrwController::class, 'overdraft'])->name('product.overdraft');


        // pdf and excel here
        Route::get('product/pdf', [PdfController::class, 'index'])->name('product.pdf');


        // account
        Route::get('account/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::post('account/change', [AccountController::class, 'change'])->name('account.change');
        Route::get('account/change-password', [AccountController::class, 'changePassword'])->name('account.change-password');
        Route::post('account/save-change', [AccountController::class, 'save'])->name('account.save');





        // user permission
        Route::get('permission/role-permission', [PermissionContoller::class, 'index'])->name('permission.index');
        Route::post('permission/save', [PermissionContoller::class, 'save'])->name('permission.save');
        Route::post('permission/switch', [PermissionContoller::class, 'switch'])->name('permission.switch');




        // -----------test ------------
        Route::get('/test', [TestController::class, 'test'])->name('test');
        Route::post('ajax', [AjaxController::class, 'ajax'])->name('ajax');

        Route::get('get-data/{id}', [AjaxController::class, 'getData'])->name('get.data');
        Route::get('role/{id}', [AjaxController::class, 'role'])->name('switch.role');
        Route::get('get-auto', [AjaxController::class, 'getAuto']);

        Route::get('get-section/{id}', [AjaxController::class, 'getsection'])->name('get.section');
        Route::get('get-position/{id}', [AjaxController::class, 'getposition'])->name('get.position');



        // --------------- Purchase Request -------------

        Route::get('/pr/purchasing/list', [PurchaserequestController::class, 'index'])->name('purchase.index');
        Route::get('/pr/purchase/request', [PurchaserequestController::class, 'request'])->name('purchase.request');
        Route::post('/pr/purchase/request/save', [PurchaserequestController::class, 'save'])->name('purchase.save');
        Route::get('/pr/purchase/request/{id}/edit', [PurchaserequestController::class, 'edit'])->name('purchase.edit');
        Route::post('/pr/purchase/request/{id}/doedit', [PurchaserequestController::class, 'doedit'])->name('purchase.doedit');
        Route::post('/pr/purchase/request/{id}/delete', [PurchaserequestController::class, 'delete'])->name('purchase.delete');
        Route::post('/pr/purchase/request/{id}/recovery', [PurchaserequestController::class, 'recovery'])->name('purchase.recovery');

        Route::get('/pr/purchase/request/{id}/receive', [PurchaserequestController::class, 'receive'])->name('purchase.receive');
        Route::post('/pr/purchase/request/{id}/receive/save', [PurchaserequestController::class, 'saveReceive'])->name('purchase.saveReceive');

        Route::get('/pr/purchase/{id}/stock/add', [PurchaserequestController::class, 'addStock'])->name('purchase.addStock');

        Route::get('/pr/received/list', [PurchaserequestController::class, 'received'])->name('purchase.received');

        // Route::get('/expense/reports', [ExpensereportController::class, 'index'])->name('expense.report');
        Route::resource('/expense/purchase', ExpensereportController::class)->names('expense.purchase');
        // Route::post('/expense/reports/search', [ExpensereportController::class, 'getSearch'])->name('expense.getSearch');
        // Route::get('/expense/reports/search', [ExpensereportController::class, 'search'])->name('expense.search');
        // Route::get('/expense/reports/create', [ExpensereportController::class, 'create'])->name('expense.create');
        // Route::post('/expense/reports/save', [ExpensereportController::class, 'store'])->name('expense.save');
        // Route::get('/expense/reports/{id}/edit', [ExpensereportController::class, 'edit'])->name('expense.edit');
        // Route::post('/expense/reports/update/{id}', [ExpensereportController::class, 'update'])->name('expense.update');
        Route::get('/expense/reports/export/excel', [ExpensereportController::class, 'exportExcel'])->name('expense.exportExcel');
        Route::get('/expense/reports/export/pdf', [ExpensereportController::class, 'exportPdf'])->name('expense.exportPdf');


        /// Service Fee
        Route::resource('expense/service/fee', ServiceFeeController::class)->names('expense.service');
        Route::get('expense/service/fee/export/excel', [ServiceFeeController::class, 'exportExcel'])->name('expense.service.exportExcel');
        Route::get('expense/service/fee/export/pdf', [ServiceFeeController::class, 'exportPdf'])->name('expense.service.exportPdf');


        Route::post('/database/export', [ExportdataController::class, 'index'])->name('database.export');
        Route::get('/given-list/pdf', [ExportdataController::class, 'exportPdf'])->name('given.pdf');

        Route::get('report/inventory/list', [InventorylistController::class, 'index'])->name('inventory.list');
        Route::get('/inventory/item/{id}/detail', [InventorylistController::class, 'show'])->name('inventory.show');
        Route::get('/inventory/list/export/excel', [InventorylistController::class, 'exportExcel'])->name('inventory.exportExcel');
        Route::get('/inventory/list/export/pdf', [InventorylistController::class, 'exportPdf'])->name('inventory.exportPdf');

        //return item out of list
        Route::resource('returned/item/out-list', ReturnOutlistController::class)->names('returnOutList');
        Route::get('returned/item/out-list/export/excel', [ReturnOutlistController::class, 'exportExcel'])->name('returnOutList.exportExcel');
        Route::get('returned/item/out-list/export/pdf', [ReturnOutlistController::class, 'exportPdf'])->name('returnOutList.exportPdf');



        // report alls
        Route::resource('reports', ReportController::class)->names('reports');
        Route::get('reports/all/expenses/export/excel', [ReportController::class, 'exportExpenseExcel'])->name('reports.exportExpenseExcel');
        Route::get('reports/all/expenses/export/pdf', [ReportController::class, 'exportExpensePdf'])->name('reports.exportExpensePdf');

        Route::resource('reports/all/expenses', ExpenseController::class)->names('expenses');
        Route::resource('reports/item/givens', GivenReportController::class)->names('givens');
        Route::resource('reports/item/returneds', ReturnedReportController::class)->names('returneds');

    });



