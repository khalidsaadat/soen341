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

            return ['payments'=>$mockPayments];
        }

        public function testCorrectVisaLength() {
            $mockData = $this->mockData();
            $payments = $mockData['payments'];
            $visa = $payments[0];

            $correct_visa_length = $visa['length'];
            $entered_visa_number = '4111111111111111';
            $visa_length = strlen($entered_visa_number);

            $this->assertEquals($visa_length, $correct_visa_length, 'Invalid credit card number');
        }

        public function testIncorrectVisaLength() {
            $mockData = $this->mockData();
            $payments = $mockData['payments'];
            $visa = $payments[0];

            $correct_visa_length = $visa['length'];
            $entered_visa_number = '41111111111111111';
            $visa_length = strlen($entered_visa_number);

            $this->assertNotEquals($visa_length, $correct_visa_length, 'Invalid credit card number');
        }
    }

?>