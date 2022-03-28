<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test',function(){
    return view('style');
});
Route::get('/',[App\Http\Controllers\Resident\HomeController::class,'index'])->name('home');
Route::get('/listing/view/{slug}', [App\Http\Controllers\Resident\HomeController::class, 'viewListing'])->name('view-listing');
Route::post('/tenant/application/register', [App\Http\Controllers\Resident\HomeController::class, 'registerNewTenantApplication'])->name('register-tenant-app');
Route::post('/tenant/application/schedule-inspection', [App\Http\Controllers\Resident\HomeController::class, 'schedulePropertyInspection'])->name('schedule-property-inspection');
Route::get('/property-listing', [App\Http\Controllers\Resident\HomeController::class, 'propertyListing'])->name('property-listing');
Route::get('/pricing', [App\Http\Controllers\Resident\HomeController::class, 'pricing'])->name('pricing');
Route::get('/search-for-property', [App\Http\Controllers\Resident\HomeController::class, 'searchForProperty'])->name('search-for-property');


Route::get('/view-advert/{slug}', [App\Http\Controllers\Resident\HomeController::class, 'viewAdvert'])->name('view-advert');
Route::get('/contact-vendors/{slug}', [App\Http\Controllers\Resident\HomeController::class, 'contactVendor'])->name('contact-vendors');
Route::get('/advert/by/category/{slug}', [App\Http\Controllers\Resident\HomeController::class, 'getAdvertByCategory'])->name('get-advert-by-category');
Route::get('/faqs', [App\Http\Controllers\Resident\HomeController::class, 'faqs'])->name('faqs');
Route::get('/tips', [App\Http\Controllers\Resident\HomeController::class, 'tips'])->name('tips');
Route::get('/terms', [App\Http\Controllers\Resident\HomeController::class, 'terms'])->name('terms');
Route::get('/policies', [App\Http\Controllers\Resident\HomeController::class, 'policies'])->name('policies');

#Payment integration route
Route::post('/make-payment', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('make-online-payment');
Route::get('/process-payment', [App\Http\Controllers\PaymentController::class, 'handleGatewayCallback']);
Route::get('/subscription', [App\Http\Controllers\Manager\AccountingController::class, 'showOurPricingForm'])->name('subscription');
Route::post('/subscription', [App\Http\Controllers\PaymentController::class, 'validateSubscription']);

#Tenant/Resident routes
Route::prefix('resident')->group(function(){
Route::get('/profile', [App\Http\Controllers\Resident\ResidentController::class, 'profile'])
    ->name('profile');
Route::get('/my-leases', [App\Http\Controllers\Resident\ResidentController::class, 'myLeases'])
        ->name('my-leases');
Route::get('/tenant/property/detail/{slug}', [App\Http\Controllers\Resident\ResidentController::class, 'propertyDetails'])
    ->name('listing-property-detail');
Route::get('/tenant/pay-rent', [App\Http\Controllers\Resident\ResidentController::class, 'payRent'])
    ->name('pay-rent');
Route::get('/settings', [App\Http\Controllers\Resident\ResidentController::class, 'showSettingsForm'])
    ->name('settings');
Route::post('/settings', [App\Http\Controllers\Resident\ResidentController::class, 'updateTenantRecord']);
Route::post('/change-password', [App\Http\Controllers\Resident\ResidentController::class, 'changePassword'])
    ->name('change-password');
Route::get('/maintenance', [App\Http\Controllers\Resident\ResidentController::class, 'maintenance'])
    ->name('maintenance');
Route::get('/maintenance/{slug}', [App\Http\Controllers\Resident\ResidentController::class, 'maintenanceDetail'])
    ->name('maintenance-detail');
Route::post('/maintenance/leave-comment', [App\Http\Controllers\Resident\ResidentController::class, 'storeLeaveFrontendConversation'])
    ->name('maintenance-leave-comment');
Route::get('/maintenance/new/maintenance-request', [App\Http\Controllers\Resident\ResidentController::class, 'showMaintenanceRequestForm'])
    ->name('new-maintenance-request');
Route::post('/maintenance/new/maintenance-request', [App\Http\Controllers\Resident\ResidentController::class, 'storeNewMaintenanceRequest']);
Route::get('/notifications', [App\Http\Controllers\Resident\ResidentController::class, 'notifications'])
        ->name('notifications');
Route::get('/mark-all-as-read', [App\Http\Controllers\Resident\ResidentController::class, 'markAllAsRead'])
        ->name('mark-all-as-read');

    Route::get('/my-messages', [App\Http\Controllers\Resident\CustomerController::class, 'myMessages'])
    ->name('my-messages');
    Route::get('/message/read/{slug}', [App\Http\Controllers\Resident\CustomerController::class, 'readMessage'])
    ->name('read-message');
    Route::post('/message/reply', [App\Http\Controllers\Resident\CustomerController::class, 'replyMessage'])
    ->name('reply-message');


//Route::get('/my-dashboard', [App\Http\Controllers\Resident\CustomerController::class, 'myDashboard'])->name('my-dashboard');
    Route::get('/wishlist', [App\Http\Controllers\Resident\CustomerController::class, 'wishlist'])->name('wishlist');



    Route::post('/save-changes', [App\Http\Controllers\Resident\CustomerController::class, 'saveChanges'])->name('save-changes');
    Route::get('/my-adverts', [App\Http\Controllers\Resident\CustomerController::class, 'myAdverts'])->name('my-adverts');
    Route::get('/advert/detail/{slug}', [App\Http\Controllers\Resident\CustomerController::class, 'myAdvertDetail'])->name('my-advert-detail');
    Route::post('/message-seller', [App\Http\Controllers\Resident\CustomerController::class, 'messageSeller'])->name('message-seller');
    Route::post('/report-seller', [App\Http\Controllers\Resident\CustomerController::class, 'reportSeller'])->name('report-seller');
#Finance routes
    Route::get('/my-reports', [App\Http\Controllers\Resident\ReportController::class, 'myReports'])->name('my-reports');
    Route::get('/my-reports/receipt/{slug}', [App\Http\Controllers\Resident\ReportController::class, 'myReceiptDetails'])->name('my-receipt-details');
    Route::get('/my-reports/invoice/{slug}', [App\Http\Controllers\Resident\ReportController::class, 'myInvoiceDetails'])->name('my-invoice-details');

#Occupant routes
    Route::get('/my-occupants', [App\Http\Controllers\Resident\OccupantController::class, 'occupants'])->name('my-occupants');
    Route::get('/add-new-occupant', [App\Http\Controllers\Resident\OccupantController::class, 'showAddNewOccupantForm'])->name('add-new-occupant');
    Route::post('/add-new-occupant', [App\Http\Controllers\Resident\OccupantController::class, 'storeNewTenantOccupant']);
    Route::post('/update-occupant', [App\Http\Controllers\Resident\OccupantController::class, 'updateTenantOccupant'])->name('update-occupant');

#Domestic staff routes
    Route::get('/my-domestic-staff', [App\Http\Controllers\Resident\DomesticStaffController::class, 'domesticStaff'])->name('my-domestic-staff');
    Route::get('/add-new-domestic-staff', [App\Http\Controllers\Resident\DomesticStaffController::class, 'showAddNewDomesticStaffForm'])->name('add-new-domestic-staff');
    Route::post('/add-new-domestic-staff', [App\Http\Controllers\Resident\DomesticStaffController::class, 'storeNewTenantDomesticStaff']);
    Route::post('/update-domestic-staff', [App\Http\Controllers\Resident\DomesticStaffController::class, 'updateTenantDomesticStaff'])->name('update-domestic-staff');

});

#Vendor routes
Route::prefix('/vendors')->group(function(){
    Route::get('/manage-vendors', [App\Http\Controllers\Manager\VendorController::class, 'manageVendors'])->name('manage-vendors');
    Route::get('/add-new-vendor', [App\Http\Controllers\Manager\VendorController::class, 'showAddNewVendorForm'])->name('add-new-vendor');
    Route::post('/add-new-vendor', [App\Http\Controllers\Manager\VendorController::class, 'storeNewVendor']);
    Route::get('/vendor-categories', [App\Http\Controllers\Manager\VendorController::class, 'manageVendorCategories'])->name('vendors-categories');
    Route::post('/vendor-categories', [App\Http\Controllers\Manager\VendorController::class, 'storeNewCategory']);
    Route::post('/update-category', [App\Http\Controllers\Manager\VendorController::class, 'updateCategory'])->name('update-vendor-category');
    Route::get('/view/{slug}', [App\Http\Controllers\Manager\VendorController::class, 'viewVendor'])->name('view-vendor');
    Route::post('/update-vendor', [App\Http\Controllers\Manager\VendorController::class, 'updateVendor'])->name('update-vendor');
});

#Bills routes
Route::prefix('/bills')->group(function(){
    Route::get('/manage-bills',[App\Http\Controllers\Manager\BillController::class, 'manageBills'] )->name('manage-bills');
    Route::get('/raise-bill',[App\Http\Controllers\Manager\BillController::class, 'showNewBillForm'] )->name('raise-bill');
    Route::post('/generate-new-bill', [App\Http\Controllers\Manager\BillController::class, 'generateNewBill'])->name('generate-new-bill');
    Route::get('/view-bill/{slug}', [App\Http\Controllers\Manager\BillController::class, 'viewBill'])->name('view-bill');

    Route::get('/manage-payments', [App\Http\Controllers\Manager\BillController::class, 'managePayments'])->name('manage-payments');
    Route::get('/decline-bill/{slug}', [App\Http\Controllers\Manager\BillController::class, 'declineBill'])->name('decline-bill');
    Route::get('/approve-bill/{slug}', [App\Http\Controllers\Manager\BillController::class, 'approveBill'])->name('approve-bill');
    Route::get('/send-bill-via-email/{slug}', [App\Http\Controllers\Manager\BillController::class, 'sendBillAsEmail'])->name('send-bill-via-email');
    Route::get('/make-payment/{slug}', [App\Http\Controllers\Manager\BillController::class, 'makePayment'])->name('make-payment');
    Route::post('/make-payment', [App\Http\Controllers\Manager\BillController::class, 'processNewPayment'])->name('process-bill-payment');
    Route::get('/manage/payment/{ref}', [App\Http\Controllers\Manager\BillController::class, 'viewPayment'])->name('view-payment-detail');

    Route::get('manage/payment/approve/{ref}', [App\Http\Controllers\Manager\BillController::class, 'approvePayment'])->name('approve-payment');
    Route::get('manage/payment/decline/{ref}', [App\Http\Controllers\Manager\BillController::class, 'declinePayment'])->name('decline-payment');

});
Route::prefix('settings')->group(function(){
    Route::get('/general-settings', [App\Http\Controllers\Manager\SettingsController::class, 'showGeneralSettingsForm'])->name('general-settings');
    Route::post('/payment-integration', [App\Http\Controllers\Manager\SettingsController::class, 'savePaymentIntegration'])->name('app-payment-integration');
    Route::post('/update-bulk-sms-settings', [App\Http\Controllers\Manager\SettingsController::class, 'updateBulkSmsSettings'])->name('update-bulk-settings');
    Route::post('/general-settings', [App\Http\Controllers\Manager\SettingsController::class, 'saveGeneralSettings']);
    Route::get('/service-settings', [App\Http\Controllers\Manager\SettingsController::class, 'showGeneralServiceSettingsForm'])->name('service-settings');
    Route::post('/service-settings', [App\Http\Controllers\Manager\SettingsController::class, 'registerNewService']);
    Route::post('/update-service', [App\Http\Controllers\Manager\SettingsController::class, 'updateService'])->name('update-service');
    Route::post('/update-bank-details', [App\Http\Controllers\Manager\SettingsController::class, 'updateBankDetails'])->name('update-bank-details');
});
Route::post('/get-location', [App\Http\Controllers\Resident\CustomerController::class, 'getLocations']);
Route::post('/get-subcategories', [App\Http\Controllers\Resident\CustomerController::class, 'getSubcategories']);

Route::get('/post-your-ad', [App\Http\Controllers\Resident\AdsController::class, 'showPostAdsForm'])->name('post-your-ad');
Route::post('/post-your-ad', [App\Http\Controllers\Resident\AdsController::class, 'postAds']);
Route::post('/initialize-defaults', [App\Http\Controllers\Resident\AdsController::class, 'initializeDefaults']);
Route::post('/get-subcategories', [App\Http\Controllers\Resident\AdsController::class, 'getSubcategories']);
Route::post('/get-areas', [App\Http\Controllers\Resident\AdsController::class, 'getAreas']);



/*
* Manager::Home routes
*/
//Route::get('/manager-login', [App\Http\Controllers\Auth\LoginController::class, 'managerLogin'])->name('manager-login');
//Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'loginTenant'])->name('login-tenant');
Route::get('/dashboard', [App\Http\Controllers\Manager\HomeController::class, 'dashboard'])->name('dashboard');

#Tenant route


/*
* Add New Lease
*/
Route::get('/add-new-lease', [App\Http\Controllers\Manager\LeaseController::class, 'showNewLeaseForm'])->name('add-new-lease');
Route::post('/add-new-lease', [App\Http\Controllers\Manager\LeaseController::class, 'storeNewLease']);

Route::get('/add-new-tenant', [App\Http\Controllers\Manager\TenantController::class, 'showNewTenantForm'])->name('add-new-tenant');


Route::get('/lease-applications', [App\Http\Controllers\Manager\LeaseController::class, 'leaseApplications'])->name('lease-applications');
Route::get('/new-lease-application', [App\Http\Controllers\Manager\LeaseController::class, 'showAddNewLeaseApplicationForm'])->name('add-lease-application');
Route::post('/new-lease-application', [App\Http\Controllers\Manager\LeaseController::class, 'saveNewLeaseApplication']);
Route::get('/generate-invoice-for/{applicant}/{property}', [App\Http\Controllers\Manager\LeaseController::class, 'generateNewInvoiceFor'])->name('generate-invoice-for');
Route::post('/lease/generate-invoice-for', [App\Http\Controllers\Manager\LeaseController::class, 'saveApplicantNewInvoice'])->name('lease-generate-invoice-for');
Route::get('/manage-leases', [App\Http\Controllers\Manager\LeaseController::class, 'showLeases'])->name('leases');
Route::post('/lease/get-property/', [App\Http\Controllers\Manager\LeaseController::class, 'getProperty']);
Route::post('/lease/get-applicant/', [App\Http\Controllers\Manager\LeaseController::class, 'getApplicant']);
#Route::get('/lease/application/{slug}', [App\Http\Controllers\Manager\LeaseController::class, 'viewLeaseApplication'])->name('view-lease-application');
Route::post('/lease/process-lease-application', [App\Http\Controllers\Manager\LeaseController::class, 'processLeaseApplication'])->name('process-lease-application');
Route::get('/lease/view/{slug}', [App\Http\Controllers\Manager\LeaseController::class, 'viewLease'])->name('view-lease');
Route::get('/lease/schedule-lease', [App\Http\Controllers\Manager\LeaseController::class, 'showScheduleLeaseForm'])->name('schedule-lease');
Route::post('/lease/update-lease-schedule', [App\Http\Controllers\Manager\LeaseController::class, 'updateLeaseSchedule'])->name('update-lease-schedule');


/*
* Applicant routes
*/
Route::get('/new-application', [App\Http\Controllers\Manager\ApplicationController::class, 'showApplicationForm'])->name('new-application');
Route::post('/new-application', [App\Http\Controllers\Manager\ApplicationController::class, 'storeApplication']);
Route::get('/prospect-applications', [App\Http\Controllers\Manager\ApplicationController::class, 'showProspectApplications'])->name('prospect-applications');
Route::get('/view/application/{slug}', [App\Http\Controllers\Manager\ApplicationController::class, 'viewApplication'])->name('view-application');
Route::get('/prospect-application/approve/{slug}/{applicant}', [App\Http\Controllers\Manager\ApplicationController::class, 'approveProspectApplication'])->name('approve-prospect-application');
/*
* Property routes
*/
Route::get('/properties', [App\Http\Controllers\Manager\PropertyController::class, 'showProperties'])->name('properties');
Route::get('/add/property', [App\Http\Controllers\Manager\PropertyController::class, 'showAddNewPropertyForm'])->name('add-new-property');
Route::post('/add/property', [App\Http\Controllers\Manager\PropertyController::class, 'storeNewProperty'])->name('store-new-property');
Route::post('/location/area', [App\Http\Controllers\Manager\PropertyController::class, 'getLocationArea']);
Route::get('/property/view/{slug}', [App\Http\Controllers\Manager\PropertyController::class, 'viewProperty'])->name('view-property');
Route::get('/property/property-inspection', [App\Http\Controllers\Manager\PropertyController::class, 'propertyInspection'])->name('property-inspection');
Route::post('/property/property-inspection', [App\Http\Controllers\Manager\PropertyController::class, 'assignPropertyInspectionToUser']);
Route::post('update-property-inspection-status', [App\Http\Controllers\Manager\PropertyController::class, 'updatePropertyInspectionStatus'])->name('update-property-inspection-status');

/*
*Rental owner routes
*/
Route::get('/rental-owners', [App\Http\Controllers\Manager\RentalOwnerController::class, 'showRentalOwners'])->name('rental-owners');
Route::get('/add/rental-owner', [App\Http\Controllers\Manager\RentalOwnerController::class, 'showNewRentalOwnerForm'])->name('add-new-rental-owner');
Route::post('/add/rental-owner', [App\Http\Controllers\Manager\RentalOwnerController::class, 'storeNewRentalOwnerForm']);
Route::get('/view/rental-owner/{slug}', [App\Http\Controllers\Manager\RentalOwnerController::class, 'viewRentalDetail'])->name('rental-owner-details');
Route::post('/edit/rental-owner', [App\Http\Controllers\Manager\RentalOwnerController::class, 'updateRentalOwnerForm'])->name('update-rental-owner');


/*
 * Tenant routes
 */
Route::get('/manage-tenants', [App\Http\Controllers\Manager\TenantController::class, 'getAllTenants'])->name('manage-tenants');
Route::get('/manage-tenant/view/{slug}', [App\Http\Controllers\Manager\TenantController::class, 'getTenant'])->name('view-tenant');


/*
 * Task routes
 */
Route::get('/manage-maintenance-requests', [App\Http\Controllers\Manager\TaskController::class, 'manageMaintenanceRequests'])->name('manage-maintenance-requests');
Route::get('/manage-tasks', [App\Http\Controllers\Manager\TaskController::class, 'manageTasks'])->name('manage-tasks');
Route::get('/task/management/new', [App\Http\Controllers\Manager\TaskController::class, 'showNewTaskForm'])->name('add-new-task');
Route::post('/task/management/new', [App\Http\Controllers\Manager\TaskController::class, 'storeTask']);
Route::get('/task/management/view/{slug}', [App\Http\Controllers\Manager\TaskController::class, 'viewTask'])->name('view-task');
Route::post('/manage-task/view/comment', [App\Http\Controllers\Manager\TaskController::class, 'leaveComment']);

/*
 * Accounting routes
 *
 */

Route::prefix('accounting')->group(function() {
    Route::get('/chart-of-accounts', [App\Http\Controllers\Manager\AccountingController::class, 'chartOfAccounts'])->name('chart-of-accounts');
    Route::get('/create-major-transaction-accounts', [App\Http\Controllers\Manager\AccountingController::class, 'createMajorTransactionAccounts'])->name('create-major-transaction-accounts');
    Route::get('/new/chart-of-account', [App\Http\Controllers\Manager\AccountingController::class, 'showNewChartOfAccountForm'])->name('new-chart-of-account');
    Route::post('/new/chart-of-account', [App\Http\Controllers\Manager\AccountingController::class, 'addNewChartOfAccount']);
    Route::post('/get-parent-account', [App\Http\Controllers\Manager\AccountingController::class, 'getParentAccount']);
    Route::get('/settings', [App\Http\Controllers\Manager\AccountingController::class, 'accountSettings'])->name('account-settings');
    Route::post('/account-settings', [App\Http\Controllers\Manager\AccountingController::class, 'setDefaultAccounts'])->name('store-account-settings');
    Route::post('/payment-integration-setup', [App\Http\Controllers\Manager\AccountingController::class, 'paymentIntegrationSetup'])->name('payment-integration-setup');
    #Receipt routes
    Route::get('/manage-receipts', [App\Http\Controllers\Manager\AccountingController::class, 'manageReceipts'])->name('manage-receipts');
    Route::get('/manage/receipt/{ref}', [App\Http\Controllers\Manager\AccountingController::class, 'viewReceipt'])->name('view-receipt-detail');
    Route::get('manage/receipt/approve/{ref}', [App\Http\Controllers\Manager\AccountingController::class, 'approveReceipt'])->name('approve-receipt');
    Route::get('manage/receipt/decline/{ref}', [App\Http\Controllers\Manager\AccountingController::class, 'declineReceipt'])->name('decline-receipt');
    #Invoice routes
    Route::get('/manage-invoices', [App\Http\Controllers\Manager\AccountingController::class, 'manageInvoices'])->name('manage-invoices');
    Route::get('/generate-new-invoice', [App\Http\Controllers\Manager\AccountingController::class, 'showGenerateNewInvoiceForm'])->name('generate-new-invoice');
    Route::post('/generate-new-invoice', [App\Http\Controllers\Manager\AccountingController::class, 'generateNewInvoice']);
    Route::get('/view-invoice/{slug}', [App\Http\Controllers\Manager\AccountingController::class, 'viewInvoice'])->name('view-invoice');
    Route::get('/decline-invoice/{slug}', [App\Http\Controllers\Manager\AccountingController::class, 'declineInvoice'])->name('decline-invoice');
    Route::get('/approve-invoice/{slug}', [App\Http\Controllers\Manager\AccountingController::class, 'approveInvoice'])->name('approve-invoice');
    Route::get('/send-invoice-via-email/{slug}', [App\Http\Controllers\Manager\AccountingController::class, 'sendInvoiceAsEmail'])->name('send-invoice-via-email');
    Route::get('/receive-payment/{slug}', [App\Http\Controllers\Manager\AccountingController::class, 'receivePayment'])->name('receive-payment');
    Route::post('/process-offline-receipt-payment', [App\Http\Controllers\Manager\AccountingController::class, 'processOfflineNewReceiptPayment'])->name('process-offline-payment');

    /*Route::get('/generate-receipt', [App\Http\Controllers\Manager\AccountingController::class, 'showGenerateReceipt']);
    Route::post('/generate-receipt', 'AccountingController@storeReceipt');
    Route::post('/get-debit-note-details', 'AccountingController@getDebitNoteDetails');*/


    #Report routes
    Route::get('/trial-balance', [App\Http\Controllers\Manager\AccountingController::class, 'showTrialBalance'])->name('trial-balance');
    Route::post('/trial-balance', [App\Http\Controllers\Manager\AccountingController::class, 'trialBalance']);
    Route::get('/balance-sheet', [App\Http\Controllers\Manager\AccountingController::class, 'showBalanceSheet'])->name('balance-sheet');
    Route::post('/balance-sheet', [App\Http\Controllers\Manager\AccountingController::class, 'balanceSheet']);
    Route::get('/profit-or-loss', [App\Http\Controllers\Manager\AccountingController::class, 'showProfitOrLoss'])->name('profit-or-loss');
    Route::post('/profit-or-loss', [App\Http\Controllers\Manager\AccountingController::class, 'profitOrLoss']);
    Route::get('/journal-voucher', [App\Http\Controllers\Manager\AccountingController::class, 'showJournalVoucher'])->name('journal-voucher');
    Route::post('/journal-voucher', [App\Http\Controllers\Manager\AccountingController::class, 'setNewJournalEntry']);
});

#Communication routes
Route::prefix('communication')->group(function() {
    Route::get('/email', [App\Http\Controllers\Manager\CommunicationController::class, 'manageEmailCommunication'])->name('manage-email-communication');
    Route::get('/email-templates', [App\Http\Controllers\Manager\CommunicationController::class, 'manageEmailTemplates'])->name('manage-email-templates');
    Route::get('/email-template/new', [App\Http\Controllers\Manager\CommunicationController::class, 'showEmailTemplateForm'])->name('new-email-template');
    Route::post('/email-template/new',  [App\Http\Controllers\Manager\CommunicationController::class, 'storeEmailTemplate']);
    Route::get('/email-template/edit/{slug}', [App\Http\Controllers\Manager\CommunicationController::class, 'showEditEmailTemplateForm'])->name('edit-email-template');
    Route::post('/email-template/edit',  [App\Http\Controllers\Manager\CommunicationController::class, 'editEmailTemplate'])->name('update-email-template');
    Route::get('/settings', [App\Http\Controllers\Manager\CommunicationController::class, 'emailSettings'])->name('email-settings');
    Route::get('/compose-email', [App\Http\Controllers\Manager\CommunicationController::class, 'showComposeEmailForm'])->name('compose-email');
    Route::post('/compose-email', [App\Http\Controllers\Manager\CommunicationController::class, 'composeEmail']);
    Route::post('/random-strings', [App\Http\Controllers\ResourceController::class, 'sendMails']); //send mails actually

});

Route::prefix('report')->group(function(){
    Route::get('/property', [App\Http\Controllers\Manager\ReportController::class, 'propertyReport'])->name('property-report');
    Route::get('/property/report', [App\Http\Controllers\Manager\ReportController::class, 'generatePropertyReport'])->name('generate-property-report');
    Route::get('/property/report-by-status', [App\Http\Controllers\Manager\ReportController::class, 'generatePropertyReportByStatus'])->name('generate-property-report-by-status');
    Route::get('/tenant', [App\Http\Controllers\Manager\ReportController::class, 'tenantReport'])->name('tenant-report');
    Route::get('/tenant/report', [App\Http\Controllers\Manager\ReportController::class, 'generateTenantReport'])->name('generate-tenant-report');
    Route::get('/tenant/report-by-status', [App\Http\Controllers\Manager\ReportController::class, 'generateTenantReportByStatus'])->name('generate-tenant-report-by-status');
});

#Administration routes
Route::prefix('administration')->group(function() {
    Route::get('/manage-users', [App\Http\Controllers\Manager\AdministrationController::class, 'manageUsers'])->name('manage-users');
    Route::get('/add-new-user', [App\Http\Controllers\Manager\AdministrationController::class, 'showAddNewUserForm'])->name('add-new-user');
    Route::post('/add-new-user', [App\Http\Controllers\Manager\AdministrationController::class, 'storeNewUser']);
    Route::get('/profile/{slug}', [App\Http\Controllers\Manager\AdministrationController::class, 'viewProfile'])->name('view-profile');
    Route::post('/update-profile', [App\Http\Controllers\Manager\AdministrationController::class, 'updateProfile'])->name('update-manager-profile');
    Route::post('/change-manager-password', [App\Http\Controllers\Manager\AdministrationController::class, 'changePassword'])->name('change-manager-password');

    Route::get('/manage-roles', [App\Http\Controllers\Manager\AdministrationController::class, 'manageRoles'])->name('manage-roles');
    Route::post('/new-role', [App\Http\Controllers\Manager\AdministrationController::class, 'storeNewRole']);
    Route::post('/edit-role', [App\Http\Controllers\Manager\AdministrationController::class, 'editRole'])->name('edit-role');
    Route::get('/manage-permissions', [App\Http\Controllers\Manager\AdministrationController::class, 'managePermissions'])->name('manage-permissions');
    Route::post('/new-permission', [App\Http\Controllers\Manager\AdministrationController::class, 'storeNewPermission'])->name('add-new-permission');
    Route::get('/theme/manage/theme', [App\Http\Controllers\Manager\AdministrationController::class, 'manageThemes'])->name('manage-theme');
    Route::post('/manage-theme', [App\Http\Controllers\Manager\AdministrationController::class, 'themeGalleryUpload']);
});

Route::prefix('/messages')->group(function(){
    Route::get('/phone-group',[App\Http\Controllers\Manager\SMSController::class, 'showPhoneGroupForm'])->name('phone-group');
    Route::post('/phone-group',[App\Http\Controllers\Manager\SMSController::class, 'setNewPhoneGroup']);
    Route::get('/top-up',[App\Http\Controllers\Manager\SMSController::class, 'showTopUpForm'])->name('top-up');
    Route::post('/top-up',[App\Http\Controllers\Manager\SMSController::class, 'processTopUpRequest']);
    Route::get('/compose-message',[App\Http\Controllers\Manager\SMSController::class, 'showComposeMessageForm'])->name('compose-message');
    Route::get('/preview-message',[App\Http\Controllers\Manager\SMSController::class, 'previewMessage'])->name('preview-message');
    Route::post('/send-text-message',[App\Http\Controllers\Manager\SMSController::class, 'sendTextMessage'])->name('send-text-message');
    Route::get('/bulk-messages',[App\Http\Controllers\Manager\SMSController::class, 'getBulkMessages'])->name('bulk-messages');
    Route::get('/bulk-messages/{slug}',[App\Http\Controllers\Manager\SMSController::class, 'viewBulkMessage'])->name('view-bulk-message');
});

#File management routes
Route::prefix('file-management')->group(function(){
    Route::get('/manage-files', [App\Http\Controllers\Manager\FileManagementController::class, 'manageFiles'] )->name('manage-files');
    Route::post('/manage-files', [App\Http\Controllers\Manager\FileManagementController::class, 'storeFiles'] )->name('upload-files');
    Route::post('/create-folder', [App\Http\Controllers\Manager\FileManagementController::class, 'createFolder'] )->name('create-folder');
    Route::get('/folder/{slug}', [App\Http\Controllers\Manager\FileManagementController::class, 'openFolder'] )->name('open-folder');
    Route::get('/download/{slug}', [App\Http\Controllers\Manager\FileManagementController::class, 'downloadAttachment'] )->name('download-attachment');
    Route::post('/delete-file', [App\Http\Controllers\Manager\FileManagementController::class, 'deleteAttachment'])->name('delete-file');
    Route::post('/delete-folder', [App\Http\Controllers\Manager\FileManagementController::class, 'deleteFolder'])->name('delete-folder');
});

/*
 * Authentication routes
 */
#Tenant auth routes
Auth::routes();
Route::get('/start-free-trial', [App\Http\Controllers\Auth\RegisterController::class, 'startFreeTrial'])->name('start-free-trial');
Route::post('/start-free-trial', [App\Http\Controllers\Auth\RegisterController::class, 'processStartFreeTrial']);
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
//Route::post('/tenant-login', [App\Http\Controllers\Auth\LoginController::class, 'loginTenant'])->name('tenant-login');
#Manager auth routes
Route::prefix('/authenticate')->group(function(){
    Route::get('/', [App\Http\Controllers\ManagerAuth\LoginController::class, 'showLoginForm'])->name('manager-login');
    Route::post('/', [App\Http\Controllers\ManagerAuth\LoginController::class, 'managerLogin']);
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
 * Un-authentication routes
 */
Route::get('/online-payment/{slug}', [App\Http\Controllers\PaymentController::class, 'onlinePayment'])->name('online-payment');


#Super-admin routes
Route::get('/manage-pricing-n-features', [App\Http\Controllers\SuperAdmin\PricingController::class, 'managePricingNFeatures'])->name('manage-pricing-n-features');
Route::get('/modules', [App\Http\Controllers\SuperAdmin\ModuleController::class, 'showAppModules'])->name('app-modules');
Route::post('/modules', [App\Http\Controllers\SuperAdmin\ModuleController::class, 'setNewModule'])->name('add-new-module');
Route::post('/update-module', [App\Http\Controllers\SuperAdmin\ModuleController::class, 'updateModule'])->name('update-module');
Route::get('/module-manager', [App\Http\Controllers\SuperAdmin\ModuleController::class, 'showModuleManager'])->name('module-manager');
Route::post('/module-manager', [App\Http\Controllers\SuperAdmin\ModuleController::class, 'setNewModulePermission']);
Route::post('/update-module-permission', [App\Http\Controllers\SuperAdmin\ModuleController::class, 'updateModulePermission'])->name('update-module-permission');

#FAQs routes [Backend]
Route::get('/manage-faqs', [App\Http\Controllers\Manager\FaqsController::class, 'manageFaqs'])->name('manage-faqs');
Route::get('/add-new-question-answer', [App\Http\Controllers\Manager\FaqsController::class, 'showAddNewQuestionAnswerForm'])->name('add-new-question-answer');
Route::get('/update-question-answer/{id}', [App\Http\Controllers\Manager\FaqsController::class, 'showUpdateQuestionAnswerForm'])->name('update-question-answer');
Route::post('/add-new-question-answer', [App\Http\Controllers\Manager\FaqsController::class, 'storeNewFAQ']);
Route::post('/update-question-answer', [App\Http\Controllers\Manager\FaqsController::class, 'updateFAQ'])->name('update-faq');

#Post/Blog routes
Route::prefix('/post')->group(function(){
    Route::get('/', [App\Http\Controllers\Manager\PostController::class, 'manageAllPosts'])->name('manage-posts');
    Route::get('/add-new-post', [App\Http\Controllers\Manager\PostController::class, 'showAddNewPostForm'])->name('add-new-post');
    Route::post('/add-new-post', [App\Http\Controllers\Manager\PostController::class, 'setNewPost']);
    Route::post('/add-new-category', [App\Http\Controllers\Manager\PostController::class, 'addNewCategory'])->name('add-new-category');
    Route::get('/edit/{slug}', [App\Http\Controllers\Manager\PostController::class, 'showUpdatePostForm'])->name('edit-post');
    Route::post('/update-post', [App\Http\Controllers\Manager\PostController::class, 'updatePost'])->name('update-post');
});

Route::get('/admin-route', [App\Http\Controllers\SuperAdminAuth\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin-route', [App\Http\Controllers\SuperAdminAuth\LoginController::class, 'showLoginForm']);
Route::prefix('/admin')->group(function(){
    Route::get('/duties', [App\Http\Controllers\SuperAdmin\DutiesController::class, 'index'])->name('duties');
});
