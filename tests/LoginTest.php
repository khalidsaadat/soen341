<?php

use PHPUnit\Framework\TestCase;

    class LoginTest extends TestCase {

        private function mockData() {
            $mockRepo = $this->createMock(\App\Login::class);
            
            // mock (sample) array that is used for testing purpose
            $mockUsersArray = [
                ['user_id' => 1, 'username' => 'siar@hotmail.com', 'password' => 'siar'],
                ['user_id' => 2, 'username' => 'anum@hotmail.com', 'password' => 'anum'],
            ];

            // it will uses the mock array as if it is returned from the 'user' table from db
            $mockRepo->method('fetchUsers')->willReturn($mockUsersArray);

            $users = $mockRepo->fetchUsers();

            $mockUsernames = array();
            $user_counter = 0;
            foreach($users as $user) {
                $mockUsernames[$user_counter] = $user['username'];
                $user_counter++;
            }

            // Test user
            $correct_test_user = ['user_id' => 1, 'username' => 'siar@hotmail.com', 'password' => 'siar'];
            $correct_test_username = $correct_test_user['username'];
            $correct_test_password = $correct_test_user['password'];
            $incorrect_test_username = 'siar@gmail.com';

            return ['users'=>$users, 
                    'usernames'=>$mockUsernames, 
                    'correct_test_user'=>$correct_test_user, 
                    'correct_username'=>$correct_test_username,
                    'correct_password'=>$correct_test_password];
        }

        // Test#1: Correct User
        public function testCorrectUser() {
            $mockData = $this->mockData();
            $users = $mockData['users'];
            $correct_test_user = $mockData['correct_test_user'];
            
            $this->assertContains($correct_test_user, $users, 'User does not exist');
        }

        // Test#2: Correct username
        public function testCorrectUsername() {
            $mockData = $this->mockData();
            $mockUsernames = $mockData['usernames'];
            $correct_test_username = $mockData['correct_username'];
            
            $this->assertContains($correct_test_username, $mockUsernames, 'Invalid username.');
        }

        // Test#3: Incorrect username
        public function testIncorrectUsername() {
            $mockData = $this->mockData();
            $mockUsernames = $mockData['usernames'];
            $incorrect_test_username = 'siar@gmail.com';
            
            $this->assertContains($incorrect_test_username, $mockUsernames, 'Invalid username.');
        }

        // Test#4: Correct password
        public function testCorrectPassword() {
            $mockData = $this->mockData();
            $correct_test_user = $mockData['correct_test_user'];
            $correct_test_password = $mockData['correct_password'];

            $this->assertEquals($correct_test_password, $correct_test_user['password'], 'Invalid password.');
        }

        // Test#5: Incorrect password
        public function testIncorrectPassword() {
            $mockData = $this->mockData();
            $correct_test_user = $mockData['correct_test_user'];
            $incorrect_test_password = 'Siar';

            $this->assertEquals($incorrect_test_password, $correct_test_user['password'], 'Invalid password.');
        }
    }
?>