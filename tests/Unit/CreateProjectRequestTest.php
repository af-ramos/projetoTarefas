<?php

namespace Tests\Unit\Requests\Project;

use App\Http\Requests\Project\CreateProjectRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class CreateProjectRequestTest extends TestCase
{
    public function test_validation_with_valid_data()
    {
        $data = [
            'title' => 'my project',
            'description' => 'some description',
        ];

        $request = new CreateProjectRequest();
        $request->merge($data);

        $reflection = new \ReflectionClass($request);
        $method = $reflection->getMethod('prepareForValidation');
        $method->setAccessible(true);
        $method->invoke($request);

        $rules = $request->rules();
        $validator = Validator::make($request->all(), $rules, $request->messages());

        $this->assertTrue($validator->passes());

        $this->assertEquals('MY PROJECT', $request->input('title'));
        $this->assertEquals('SOME DESCRIPTION', $request->input('description'));
    }

    public function test_validation_with_missing_fields()
    {
        $data = [];

        $request = new CreateProjectRequest();
        $request->merge($data);

        $reflection = new \ReflectionClass($request);
        $method = $reflection->getMethod('prepareForValidation');
        $method->setAccessible(true);
        $method->invoke($request);

        $rules = $request->rules();
        $validator = Validator::make($request->all(), $rules, $request->messages());

        $this->assertFalse($validator->passes());

        $errors = $validator->errors();

        $this->assertEquals('Title is mandatory', $errors->first('title'));
        $this->assertEquals('Description is mandatory', $errors->first('description'));
    }
}
