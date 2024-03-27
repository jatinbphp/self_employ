<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\SelfEmployeeController;
use App\Http\Controllers\Frontend\Post\PostController;
use App\Http\Controllers\Frontend\Portfolio\PortfolioController;
use App\Http\Controllers\Frontend\Job\JobController;
use App\Http\Controllers\Frontend\Project\ProjectController;
use App\Http\Controllers\Frontend\Home\FHomeController;
use App\Http\Controllers\Frontend\Faq\FaqController;
use App\Http\Controllers\Frontend\Payment\PaymentController;
use App\Http\Controllers\Frontend\Stripe\StripeController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\ProfileSettingController;
use App\Http\Controllers\Auth\FacebookController;

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Category\AdminCategoryController;
use App\Http\Controllers\Admin\Home\HomeController;
use App\Http\Controllers\Admin\Jobs\AdminJobController;
use App\Http\Controllers\Admin\Skills\AdminSkillController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\User\AdminUserController;
use App\Http\Controllers\Admin\Faq\AdminFaqController;
use App\Http\Controllers\Frontend\BankID\BankIDController;
use App\Http\Controllers\Frontend\Chat\ChatController;
use App\Http\Controllers\Frontend\Freelancer\FreelancerController;
use App\Http\Controllers\Frontend\Message\MessageController;
use App\Http\Controllers\Frontend\Team\TeamController;
use App\Http\Controllers\PusherController;
use Illuminate\Support\Facades\Session;
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

/**
 *
 * Frontend routes Guest
 *
 */
Route::get('test/bankid', [BankIDController::class, 'index'])->name('bankid.index');
Route::post('bankid/post', [BankIDController::class, 'bankid_post'])->name('bankid.post');
Route::group(['middleware' => ['guest']], function () {
    Route::get('login', [LoginController::class, 'index'])->name('auth.login.showform');
    Route::get('login', [LoginController::class, 'index'])->name('auth.login.showform');
    Route::post('login', [LoginController::class, 'login'])->name('auth.login.process');
    Route::get('signup', [LoginController::class, 'signup'])->name('auth.signup.showform');
    Route::post('signup', [LoginController::class, 'createUser'])->name('auth.signup.process');
    Route::post('login/modal', [LoginController::class, 'login_modal'])->name('auth.login.process.modal');
    Route::get('forgot', [LoginController::class, 'forgot'])->name('auth.forgot.showform');
    Route::post('forgot/password', [LoginController::class, 'forgot_password'])->name('auth.forgot.pass.process');
    Route::get('reset', [LoginController::class, 'reset'])->name('auth.reset.showform');
    Route::get('thankyou', [LoginController::class, 'thankyou'])->name('auth.thankyou.showform');
    Route::post('reset/password', [LoginController::class, 'reset_password'])->name('auth.reset.pass.process');
    /**
     *
     * Auth Pages Routes
     *
     */
    Route::get('register', [SelfEmployeeController::class, 'register'])->name('auth.register');
    // Route::get('reset', [SelfEmployeeController::class, 'reset'])->name('auth.reset');
    Route::get('verify', [SelfEmployeeController::class, 'verify'])->name('auth.verify');
});

Route::controller(FacebookController::class)->group(function(){
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});

/**
 *
 *
 * Frontend Routes Middleware Auth & isUser
 *
 */
Route::group(['middleware' => ['auth', 'user']], function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('auth.logout');
    //Profile

    /*---------Account Tab---------*/
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/account', [ProfileSettingController::class, 'index'])->name('profile.profile_settings.index');
    Route::post('profile/settings/update', [ProfileSettingController::class, 'update'])->name('profile.profile_settings.update');
    Route::post('profile/settings/coverUpdate', [ProfileSettingController::class, 'coverUpdate'])->name('profile.profile_settings.cover_update');
    Route::post('profile/settings/aboutUpdate', [ProfileSettingController::class, 'aboutUpdate'])->name('profile.profile_settings.about_update');
    Route::post('profile/settings/skillUpdate', [ProfileSettingController::class, 'skillUpdate'])->name('profile.profile_settings.skill_update');
    Route::post('profile/settings/imageUpdate', [ProfileSettingController::class, 'imageUpdate'])->name('profile.profile_settings.image_update');
    Route::post('profile/changepassword/update', [ProfileSettingController::class, 'update'])->name('profile.changepassword.update');
    Route::post('profile/email/update', [ProfileSettingController::class, 'emailUpdate'])->name('profile.email.update');
    Route::post('profile/password/update', [ProfileSettingController::class, 'passwordUpdate'])->name('profile.password.update');
    Route::post('profile/card/add', [ProfileSettingController::class, 'addCard'])->name('profile.card.add');
    Route::post('profile/card/delete', [ProfileSettingController::class, 'deleteCard'])->name('profile.card.delete');
    Route::post('profile/account/deactivate', [ProfileSettingController::class, 'deactivate'])->name('profile.account.deactivate');

    /*---------Finances---------*/
    Route::get('connect-bank-account', [StripeController::class, 'connectBankAccount'])->name('stripe.connectBankAccount');
    Route::post('stripe/saveConnectBankAccount', [StripeController::class, 'storeBankAccount'])->name('stripe.store.connectBankAccount');
    Route::post('stripe/getBankRequiredDetails', [StripeController::class, 'getBankRequiredDetails'])->name('stripe.getBankRequiredDetails');
    Route::post('stripe/linkGenerate', [StripeController::class, 'linkGenerate'])->name('stripe.linkGenerate');
    Route::post('stripe/payout', [StripeController::class, 'payout'])->name('stripe.payout');

    Route::get('add-funds', [PaymentController::class, 'index'])->name('page.deposit');
    Route::post('deposit', [PaymentController::class, 'stripePost'])->name('page.deposit.stripe');

    Route::get('withdraw-funds', [StripeController::class, 'withdraw_funds'])->name('page.earnings');
    Route::post('stripe/filterTransactions', [StripeController::class, 'filterTransactions'])->name('stripe.filterTransactions');


    //Portfolio
    Route::get('portfolio/{id?}', [PortfolioController::class, 'index'])->name('portfolio.index');
    Route::post('portfolio/store', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::post('portfolio/approve', [PortfolioController::class, 'approve'])->name('portfolio.approve');
    Route::post('portfolio/reject', [PortfolioController::class, 'reject'])->name('portfolio.reject');

    //Team
    Route::post('team/store', [TeamController::class, 'store'])->name('team.store');
    Route::post('team/invite', [TeamController::class, 'invite'])->name('team.invite');
    Route::post('team/delete', [TeamController::class, 'delete'])->name('team.delete');
    Route::post('team/remove', [TeamController::class, 'remove'])->name('team.remove');
    Route::post('team/leave', [TeamController::class, 'leave'])->name('team.leave');

    Route::post('team/name_update', [TeamController::class, 'name_update'])->name('team.name_update');
    Route::post('team/invite/accept', [TeamController::class, 'accept'])->name('team.invite.accept');
    Route::post('team/invite/reject', [TeamController::class, 'reject'])->name('team.invite.reject');
    Route::get('team/profile/{id?}', [TeamController::class, 'index'])->name('team.index');
    Route::post('team/getFreelancers', [TeamController::class, 'search'])->name('team.getFreelancers');

    Route::get('read-notifications', [MessageController::class, 'getNotoficationRead'])->name('notification.read');

    //Posts Add/Store
    Route::post('posts/add', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/edit/{id?}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('posts/update/{id?}', [PostController::class, 'update'])->name('posts.update');
    Route::post('getUserSkills', [ProfileSettingController::class, 'getUserSkills'])->name('profile.profile_settings.getSkills');

    Route::get('myprojects', [ProjectController::class, 'my_posts'])->name('posts.my.posts');
    Route::get('myjobs', [ProjectController::class, 'my_jobs'])->name('posts.my.jobs');
    Route::get('myjobs/{filter}', [ProjectController::class, 'my_jobs_filter'])->name('posts.my.jobs_filter');
    Route::post('update-pstatus', [PostController::class, 'update_pstatus'])->name('posts.update_pstatus');

    /**
     *
     * Chat System With Pusher
     *
     */
    Route::get('load-latest-messages', [MessageController::class, 'getLoadLatestMessages'])->name('chat.load.latest.messages');
    Route::get('read-messages', [MessageController::class, 'getReadMessages'])->name('chat.read.latest.messages');
    Route::post('send', [MessageController::class, 'postSendMessage'])->name('chat.message.send');
    Route::get('fetch-old-messages', [MessageController::class, 'getOldMessages'])->name('chat.fetch.old.messages');
    Route::get('chat', [MessageController::class, 'index'])->name('chat.users');
    Route::get('fullchat', [MessageController::class, 'fullchat'])->name('chat.users-fullscreen');
    Route::get('/emit', function () {
        \App\Events\MessageSent::broadcast(\App\Models\User::find(1));
    });


    /**
     *
     * Chat System jQuery With custom functionality
     *
     */
    //Route::get('chat', [ChatController::class, 'index'])->name('chat.users');

    // Route::post('fetch_users', [ChatController::class, 'getUser'])->name('chat.fetch.users');
    // Route::post('update_last_activity', [ChatController::class, 'updateLastActivity'])->name('chat.update.last.activity');
    // Route::post('fetch_groupchat_history', [ChatController::class, 'fetchGroupChatHistory'])->name('chat.fetch.groupchat.history');
    // Route::post('fetch_userchat_history', [ChatController::class, 'fetchUserChatHistory'])->name('chat.fetch.userchat.history');
    // Route::post('insert_chat_data', [ChatController::class, 'insertChat'])->name('chat.insertchat.data');
    // Route::post('update_istype_status', [ChatController::class, 'updateIsTypeStatus'])->name('chat.update.istype.status');
    // Route::post('remove_chat', [ChatController::class, 'removeChat'])->name('chat.remove.chat');
    // Route::post('upload_file', [ChatController::class, 'uploadFile'])->name('chat.upload.file');
    // Route::post('chat_users', [ChatController::class, 'chatUsers'])->name('chat.chatUsers');



});

Route::get('getProjects', [ProfileController::class, 'getProjects'])->name('profile.getProjects');

Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::post('getSkills', [PostController::class, 'getSkills'])->name('posts.getSkills');
Route::post('addCategory', [PostController::class, 'addCategory'])->name('posts.addCategory');
Route::post('getContent', [PostController::class, 'getContent'])->name('posts.getContent');
Route::post('getSubCategory', [PostController::class, 'getSubCategory'])->name('posts.getSubCategory');
Route::post('getJobSubCategory', [JobController::class, 'getJobSubCategory'])->name('jobs.getJobSubCategory');
Route::get('find/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::post('getJobList', [JobController::class, 'getJobList'])->name('jobs.getJobList');
Route::get('find/jobs/search', [JobController::class, 'search'])->name('jobs.view.category.search');
Route::post('find/jobs', [JobController::class, 'filter'])->name('jobs.view.category.filter');
Route::get('projects/{id?}', [ProjectController::class, 'show'])->name('projects.details');
Route::get('user/profile/{id?}', [ProjectController::class, 'viewUserProfile'])->name('user.view.profile');
Route::get('freelancer', [FreelancerController::class, 'index'])->name('user.view.freelancer');
Route::post('getFreelancerList', [FreelancerController::class, 'getFreelancerList'])->name('user.getFreelancerList');
Route::get('addNewCat', [PostController::class, 'addNewCat'])->name('addNewCat');

Route::post('projects/makeoffer', [ProjectController::class, 'makeoffer'])->name('projects.makeoffer');
Route::post('projects/hire', [ProjectController::class, 'hire'])->name('projects.hire');
Route::post('projects/acceptoffer', [ProjectController::class, 'acceptoffer'])->name('projects.acceptoffer');
Route::post('projects/useracceptoffer', [ProjectController::class, 'userAcceptOffer'])->name('projects.user.acceptoffer');
Route::post('projects/createmilestone', [ProjectController::class, 'createMilestone'])->name('projects.createmilestone');
Route::post('projects/releasemilestone', [ProjectController::class, 'releaseMilestone'])->name('projects.releasemilestone');
Route::post('projects/deleteproject', [ProjectController::class, 'deleteProject'])->name('projects.deleteproject');

//Route::get('jobs', [SelfEmployeeController::class, 'jobs'])->name('jobs.index');
Route::get('/', [FHomeController::class, 'index'])->name('home.index');
Route::post('job/search', [FHomeController::class, 'search'])->name('home.job.search');

/**
 *
 * Content Pages Routes
 *
 */
Route::get('expert', [SelfEmployeeController::class, 'expert'])->name('expert.index');
Route::get('offers', [SelfEmployeeController::class, 'offers'])->name('offers.index');
Route::get('projects', [SelfEmployeeController::class, 'projects'])->name('projects.index');


Route::get('faqs', [FaqController::class, 'index'])->name('page.faqs');
Route::get('selfemployment', [SelfEmployeeController::class, 'why_self_employee'])->name('page.why.self.employee');
Route::get('howitworks', [SelfEmployeeController::class, 'how_works'])->name('page.how.it.works');
//Route::get('earnings', [SelfEmployeeController::class, 'earnings'])->name('page.earnings');
Route::get('supports', [SelfEmployeeController::class, 'support'])->name('page.support');
Route::post('searchSupports', [SelfEmployeeController::class, 'searchSupports'])->name('page.searchSupports');
Route::get('categories', [SelfEmployeeController::class, 'categories'])->name('page.categories');
Route::get('contact', [SelfEmployeeController::class, 'contact'])->name('page.contact');
Route::get('terms', [SelfEmployeeController::class, 'terms'])->name('page.terms');
Route::get('about', [SelfEmployeeController::class, 'about'])->name('page.about');

Route::post('/pusher/auth', [PusherController::class, 'pusherAuth'])->middleware('auth');





















/**
 *
 * Admin Dashboard Routes Guest Login
 *
 */

Route::group(['prefix' => 'admin', 'middleware' => ['guest']], function () {
    Route::get('login', [AdminLoginController::class, 'index'])->name('auth.admin.login.form');
    Route::post('login', [AdminLoginController::class, 'login'])->name('auth.admin.login.process');

    Route::get('register', [SelfEmployeeController::class, 'admin_register'])->name('page.admin.register');
    Route::get('reset-password', [SelfEmployeeController::class, 'admin_reset'])->name('page.admin.reset');
    Route::get('new-password', [SelfEmployeeController::class, 'admin_new'])->name('page.admin.new');
    Route::get('2step', [SelfEmployeeController::class, 'admin_2step'])->name('page.admin.2step');
});

/**
 *
 * Admin Dashboard Routes Middleware Validation Auth, isAdmin
 *
 */

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.auth.logout');
    Route::get('change-password', [AdminLoginController::class, 'change_password'])->name('admin.auth.change-password');
    Route::post('change-password', [AdminLoginController::class, 'changePasswordProcess'])->name('auth.admin.change-password.process');
    Route::get('home', [HomeController::class, 'index'])->name('page.admin');
    Route::get('profile', [SelfEmployeeController::class, 'admin_profile'])->name('page.admin.profile');

    /**
     *
     * User Page
     *
     */
    Route::get('user', [AdminUserController::class, 'index'])->name('admin.user');
    Route::get('user/list', [AdminUserController::class, 'getUsers'])->name('admin.user.list');
    Route::get('user/view/{id?}', [AdminUserController::class, 'show'])->name('admin.user.detail');
    Route::get('user/projects/view/{id?}', [AdminUserController::class, 'show_projects'])->name('admin.user.project.detail');

    Route::get('user/add', [AdminUserController::class, 'create'])->name('admin.user.add');
    Route::post('user/store', [AdminUserController::class, 'store'])->name('admin.user.store');

    Route::get('user/edit/{id?}', [AdminUserController::class, 'edit'])->name('admin.user.edit');
    Route::post('user/update/{id?}', [AdminUserController::class, 'update'])->name('admin.user.update');

    Route::delete('user/delete', [AdminUserController::class, 'delete'])->name('admin.user.delete');

    Route::post('user/updateStatus', [AdminUserController::class, 'updateStatus'])->name('admin.user.updateStatus');


    /**
     *
     * Category Page Admin
     *
     */
    Route::get('categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
    Route::get('categories/list', [AdminCategoryController::class, 'getCategories'])->name('admin.categories.list');
    Route::get('categories/view/{id?}', [AdminCategoryController::class, 'show'])->name('admin.categories.detail');

    Route::get('categories/add', [AdminCategoryController::class, 'create'])->name('admin.categories.add');
    Route::post('categories/store', [AdminCategoryController::class, 'store'])->name('admin.categories.store');

    Route::get('categories/edit/{id?}', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('categories/update/{id?}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');

    Route::delete('categories/delete', [AdminCategoryController::class, 'delete'])->name('admin.categories.delete');

    /*Sub Category Admin*/
    Route::get('sub_categories/list', [SubCategoryController::class, 'getSubCategories'])->name('admin.sub_categories.list');
    Route::post('sub_categories/update/{id?}', [SubCategoryController::class, 'update'])->name('admin.sub_categories.update');
    Route::resource('sub_categories', SubCategoryController::class);

    /**
     *
     * Skills Page Admin
     *
     */
    Route::get('skills', [AdminSkillController::class, 'index'])->name('admin.skills');
    Route::get('skills/list', [AdminSkillController::class, 'getSkills'])->name('admin.skills.list');
    Route::get('skills/view/{id?}', [AdminSkillController::class, 'show'])->name('admin.skills.detail');

    Route::get('skills/add', [AdminSkillController::class, 'create'])->name('admin.skills.add');
    Route::post('getSubCategroy', [AdminSkillController::class, 'getSubCategroy'])->name('admin.skills.getSubCategory');
    Route::post('skills/store', [AdminSkillController::class, 'store'])->name('admin.skills.store');

    Route::get('skills/edit/{id?}', [AdminSkillController::class, 'edit'])->name('admin.skills.edit');
    Route::post('skills/update/{id?}', [AdminSkillController::class, 'update'])->name('admin.skills.update');

    Route::delete('skills/delete', [AdminSkillController::class, 'delete'])->name('admin.skills.delete');

    /**
     *
     * Job Page Admin
     *
     */
    Route::get('jobs', [AdminJobController::class, 'index'])->name('admin.jobs');
    Route::get('jobs/list', [AdminJobController::class, 'getJobs'])->name('admin.jobs.list');
    Route::get('jobs/view/{id?}', [AdminJobController::class, 'show'])->name('admin.jobs.detail');

    Route::get('job/add', [AdminUserController::class, 'create'])->name('admin.job.add');
    Route::post('job/store', [AdminUserController::class, 'store'])->name('admin.job.store');

    Route::get('job/edit/{id?}', [AdminUserController::class, 'edit'])->name('admin.job.edit');
    Route::post('job/update/{id?}', [AdminUserController::class, 'update'])->name('admin.job.update');

    Route::delete('jobs/delete', [AdminJobController::class, 'delete'])->name('admin.jobs.delete');

    /**
     *
     * Faqs Page Admin
     *
     */
    Route::get('faqs', [AdminFaqController::class, 'index'])->name('admin.faqs');
    Route::get('faqs/list', [AdminFaqController::class, 'getFaqs'])->name('admin.faqs.list');
    Route::get('faqs/view/{id?}', [AdminFaqController::class, 'show'])->name('admin.faqs.detail');

    Route::get('faqs/add', [AdminFaqController::class, 'create'])->name('admin.faqs.add');
    Route::post('faqs/store', [AdminFaqController::class, 'store'])->name('admin.faqs.store');

    Route::get('faqs/edit/{id?}', [AdminFaqController::class, 'edit'])->name('admin.faqs.edit');
    Route::post('faqs/update/{id?}', [AdminFaqController::class, 'update'])->name('admin.faqs.update');

    Route::delete('faqs/delete', [AdminFaqController::class, 'delete'])->name('admin.faqs.delete');
});
