<?php

namespace Tests;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\UploadedFile;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn($user = null)
    {
       $user = $user ?: factory(User::class)->create();

       $this->actingAs($user);

       return $user;
    }
    
    /**
     * Generate a super admin user.
     *
     * @return mixed|null
     */
    public function makeAdmin()
    {
        $user = $this->signIn();
    
        $role = create(Role::class, ['name' => 'super-admin']);
    
        $user->addRole($role);
        
        return $user;
    }
    
    /**
     * Make a test file form a given file.
     *
     * @param  string  $filename
     *
     * @return UploadedFile
     */
    protected function makeTestFile(string $filename): UploadedFile
    {
        $stub = __DIR__."/Feature/{$filename}.docx";
        $name = str_random(8).'.docx';
        $path = sys_get_temp_dir().'/'.$name;

        copy($stub, $path);

        $file = new UploadedFile(
            $path,
            $name,
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            0,
            true
        );

        return $file;
    }
}
