<?php
// use App\Mail\WelcomeMail;
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
Route::redirect('/', 'posts');
Auth::routes();
Route::resources([
    '/home' => 'HomeController',
    'user' => 'UserController',
    'posts' => 'PostsController',
    'post-likes' => 'PostLikesController',
    'post-comments' => 'PostCommentsController',
    'post-comments-likes' => 'PostCommentLikesController',
    'polls' => 'PollsController',
    'audios' => 'AudiosController',
    'audio-likes' => 'AudioLikesController',
    'audio-comments' => 'AudioCommentsController',
    'audio-comment-likes' => 'AudioCommentLikesController',
    'audio-albums' => 'AudioAlbumsController',
    'audio-notifications' => 'AudioNotificationsController',
    'videos' => 'VideosController',
    'video-likes' => 'VideoLikesController',
    'video-comments' => 'VideoCommentsController',
    'video-comment-likes' => 'VideoCommentLikesController',
    'video-albums' => 'VideoAlbumsController',
    'video-notifications' => 'VideoNotificationsController',
    'library' => 'BoughtVideosController',
    'follows' => 'FollowsController',
    'follow-notifications' => 'FollowNotificationsController',
    'cart' => 'CartVideosController',
    'cart-audio' => 'CartAudiosController',
    'referrals' => 'ReferralsController',
    'search' => 'SearchController',
    'admin' => 'PayoutsController',
    'notifications' => 'NotificationsController',
    'kopokopo' => 'KopokopoController',
]);
/* Video charts route */
Route::get('/video-charts/{chart}/{vGenre}', [
    'as' => 'charts.index',
    'uses' => 'VideoChartsController@index',
]);
Route::resource('video-charts', 'VideoChartsController', ['except' => 'index']);
/* Audio charts route */
Route::get('/audio-charts/{chart}/{vGenre}', [
    'as' => 'audio-charts.index',
    'uses' => 'AudioChartsController@index',
]);
Route::resource('audio-charts', 'AudioChartsController', ['except' => 'index']);
Route::view('social', '/auth/social');
// Route::get('email', function () {

//     Mail::to('alphaxardgacuuru47@gmail.com')->send(new WelcomeMail());

//     return new WelcomeMail();
// });

Route::get('login/{website}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{website}/callback', 'Auth\LoginController@handleProviderCallback');

// usage inside a laravel route
Route::get('image', function () {
    $img = Image::make('2015_lamborghini_aventador_roadster_prestige_imports-3840x2160.jpg')->resize(1600, 900);

    return $img->response('jpg', 100);
});
