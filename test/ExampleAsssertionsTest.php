<?php
use PHPUnit\Framework\TestCase;

    class ExampleAsssertionsTest extends TestCase {
        public function testThatStringMatch() {
            
            $string1 = 'match';
            $string2 = 'match';

            $string3 = 'Match';

            $this->assertSame($string1, $string3);
            // $this->assertSame($string1, $string3);
        }

        public function testTheSummation() {
            $this->assertSame(10, 5+5);

            // $this->assertSame(10, 5+3);
        }
    }
?>