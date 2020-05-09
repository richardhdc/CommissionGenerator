<?php

use Lib\Service\FileReader;
use PHPUnit\Framework\TestCase;

class FileReaderTest extends TestCase
{
    public function testFileExist()
    {
        $fileReader = new FileReader;
        $fileReader->read("input.txt");
        $this->assertTrue($fileReader->hasContent());
    }

    public function testFileOrUrlNotExist()
    {
        $fileReader = new FileReader;
        $fileReader->read("nofile.txt");
        $this->assertFalse($fileReader->hasContent());
    }

    public function testFileContent()
    {
        $fileReader = new FileReader;
        $fileReader->read("input.txt");
        $this->assertCount(6, $fileReader->getDataArray());
    }

}