<?php

Route::group([
    'prefix' => 'admin/qa',
    'middleware' => ['web', 'admin', 'acl'],
    'namespace' => 'Modules\Qa\Http\Controllers\Admin'],
    function () {
        Route::get('/', ['as' => 'admin.question.index', 'permissions' => 'question:view', 'uses' => 'QuestionController@getIndex']);

        Route::get('/{questionId}/delete', [
            'as' => 'admin.question.delete',
            'permissions' => 'question:delete',
            'uses' => 'QuestionController@getDelete'
        ]);

        // Danh sách câu trả lời cho 1 câu hỏi
        Route::get('/{questionId}/answer', ['as' => 'admin.answer.index', 'permissions' => 'answer:view', 'uses' => 'AnswerController@getIndex']);

        // Tạo câu trả lời
        Route::get('/{questionId}/answer/create', [
            'as' => 'admin.answer.create',
            'permissions' => 'answer:create',
            'uses' => 'AnswerController@getCreate'
        ]);

        Route::post('/{questionId}/answer/create', 'AnswerController@postCreate');

        // Sửa câu trả lời
        Route::get('/answer/{answerId}/edit', [
            'as' => 'admin.answer.edit',
            'permissions' => 'answer:edit',
            'uses' => 'AnswerController@getEdit'
        ]);

        Route::post('/answer/{answerId}/edit', 'AnswerController@postEdit');

        // Xóa câu trả lời
        Route::get('/answer/{answerId}/delete', [
            'as' => 'admin.answer.delete',
            'permissions' => 'answer:delete',
            'uses' => 'AnswerController@getEdit'
        ]);
    }
);
