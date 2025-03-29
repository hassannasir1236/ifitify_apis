<?php

use App\Http\Controllers\Admin\WorkoutsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SendPasswordResetEmailController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\VerifyOTPController;
use App\Http\Controllers\Exercises\CreateExerciseCategoryController;
use App\Http\Controllers\Exercises\CreateExerciseController;
use App\Http\Controllers\Exercises\CreateExerciseEquipmentController;
use App\Http\Controllers\Exercises\CreateExerciseVideoController;
use App\Http\Controllers\Exercises\GetExerciseCategoriesController;
use App\Http\Controllers\Exercises\GetExerciseEquipmentTypesController;
use App\Http\Controllers\Exercises\GetExerciseEquipmentController;
use App\Http\Controllers\Exercises\GetExerciseVideosController;
use App\Http\Controllers\Exercises\FitInMinutesWorkoutsController;
use App\Http\Controllers\Exercises\SaveIntervalWorkoutController;
use App\Http\Controllers\Exercises\GetIntervalWorkoutController;
use App\Http\Controllers\Goals\ChangeUserGoalController;
use App\Http\Controllers\Goals\GetGoalsController;
use App\Http\Controllers\User\DeleteUserAccountController;
use App\Http\Controllers\User\EditProfileController;
use App\Http\Controllers\User\GetExercisePlaylistController;
use App\Http\Controllers\User\GetUserProfileController;
use App\Http\Controllers\User\SaveExercisePlaylistController;
use App\Http\Controllers\User\UploadBeforeImageController;
use App\Http\Controllers\User\UploadProfilePictureController;
use App\Http\Controllers\User\UploadAfterImageController;
use App\Http\Controllers\User\UploadWorkoutImageController;
use App\Http\Controllers\User\WorkoutLogsController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Exercises\StoreExerciseController;
use App\Http\Controllers\User\DeleteExerciseController;
use App\Http\Controllers\User\ReplaceUserExerciseController;
use App\Http\Controllers\User\ExerciseController;
use App\Http\Controllers\User\WorkoutController;
use App\Http\Controllers\User\UserCalculationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/login', LoginController::class);
Route::post('auth/signup', SignupController::class);
Route::post('auth/social', SocialAuthController::class);
Route::post('auth/otp/send', SendPasswordResetEmailController::class);
Route::post('auth/password/reset', ResetPasswordController::class);
Route::post('auth/otp/verify', VerifyOTPController::class);
Route::get('v1/fitness-goals', GetGoalsController::class);
Route::post('v1/exercise/category/create', CreateExerciseCategoryController::class);
Route::post('v1/exercise/video/create', CreateExerciseVideoController::class);
Route::post('v1/exercise/create', CreateExerciseController::class);
Route::post('v1/exercise-equipment/create', CreateExerciseEquipmentController::class);

// create custom api 
Route::post('create-general-exercise', [StoreExerciseController::class, 'generalstore']);
Route::post('create-fitinmin-exercise', [StoreExerciseController::class, 'fitinminstore']);

//authenticated routes
Route::middleware(['auth:api'])->prefix('v1')->group(
    function () {
        //user endpoints
        Route::get('user/profile', GetUserProfileController::class);
        Route::post('user/fitness-goal/change', ChangeUserGoalController::class);
        Route::post('user/new-workout/create', SaveExercisePlaylistController::class);
        Route::post('user/interval-workout/create', SaveIntervalWorkoutController::class);
        Route::get('user/new-workouts', GetExercisePlaylistController::class);
        Route::get('user/interval-workouts', GetIntervalWorkoutController::class);
        Route::post('user/profile-image/upload', UploadProfilePictureController::class);
        Route::post('user/after-image/upload', UploadAfterImageController::class);
        Route::post('user/workout-image/upload', UploadWorkoutImageController::class);
        Route::post('user/before-image/upload', UploadBeforeImageController::class);
        Route::post('user/profile/edit', EditProfileController::class);
        Route::post('user/account/delete', DeleteUserAccountController::class);
        Route::post('user/workout-log/create', [WorkoutLogsController::class, 'store']);
        Route::get('user/workout-logs', [WorkoutLogsController::class, 'getUserWorkouts']);
        Route::get('user/workout-logs/{workout_id}', [WorkoutLogsController::class, 'getWorkoutLog']);
        Route::put('user/workout-logs/{log_id}', [WorkoutLogsController::class, 'updateWorkoutLog']);
        Route::put('user/{workout}/complete', [WorkoutLogsController::class, 'completeWorkout']);
        Route::patch('user/workout/duration', [WorkoutLogsController::class, 'updateDuration']);
        //exercise endpoints
        Route::get('exercise/categories', GetExerciseCategoriesController::class);
        Route::get('exercise/equipment-types', GetExerciseEquipmentTypesController::class);
        Route::get('exercise/equipments', GetExerciseEquipmentController::class);
        Route::post('exercise/videos', GetExerciseVideosController::class);
        Route::get('exercise/quick-workouts/{level?}', [FitInMinutesWorkoutsController::class, 'getCombinedWorkouts']);
        
         // create custom api 
        Route::post('exercise/quick-workout/{level?}', [FitInMinutesWorkoutsController::class, 'getExerciseByLevelAndBatch']);
        Route::post('exercise/delete', [DeleteExerciseController::class, 'detele_user_exercise']);
        Route::post('exercise/replace-exercise', [ReplaceUserExerciseController::class, 'replace_user_exercise_ids']);
        Route::post('exercise/add-exercise', [ExerciseController::class, 'addExercises']);
        Route::post('user/workout/started-interval', [WorkoutController::class, 'storeOrUpdateStartedIntervalWorkout']);
        Route::post('user/interval-workout-image/upload', [WorkoutController::class, 'intervalWorkoutImageUpload']);
        Route::post('user/interval-workout/complete', [WorkoutController::class, 'intervalWorkoutComplete']);
        
        
         // User Calcuation 
        Route::post('exercise/calculate-bmr', [UserCalculationController::class, 'calculateBMR']);
        Route::post('exercise/calculate-tdee', [UserCalculationController::class, 'calculateTDEE']);
        Route::post('exercise/calculate-goal-weight', [UserCalculationController::class, 'calculateGoalWeight']);
        Route::post('exercise/calculate-macros', [UserCalculationController::class, 'calculateMacros']);
        Route::post('exercise/calculate-body-fat', [UserCalculationController::class, 'calculateBodyFat']);
        Route::post('exercise/calculate-calories', [UserCalculationController::class, 'calculateCalories']);
        Route::post('exercise/bmr-report', [UserCalculationController::class, 'bmr_report_generate']);
        Route::post('exercise/graph-data', [ExerciseController::class, 'graphData']);
        
        Route::middleware([AdminMiddleware::class])->group(function () {
            Route::post('/admin/create-quick-workout', [WorkoutsController::class, 'createQuickWorkout']);
        });
    }
);
