<?php

use PHPUnit\Framework\TestCase;

    class PaymentTest extends TestCase {

        private function mockData() {
            $mockRepo = $this->createMock(\App\Payment::class);
            
            // mock (sample) array that is used for testing purpose
            $mockPayments = [
                ['type' => 'visa', 'length' => 16],
                ['type' => 'mastercard', 'length' => 16],
                ['type' => 'american_express', 'length' => 15],
            ];


            // Test user
            $correct_test_user = ['user_id' => 1, 'username' => 'siar@hotmail.com', 'password' => 'siar'];
            $correct_test_username = $correct_test_user['username'];
            $correct_test_password = $correct_test_user['password'];
            $incorrect_test_username = 'siar@gmail.com';

            return ['payments'=>$mockPayments];
        }

        public function testCorrectVisaLength() {
            $mockData = $this->mockData();
            $payments = $mockData['payments'];
            $visa = $payments[0];

            $correct_visa_length = $visa[2];

            // equals
        }
    }

?>