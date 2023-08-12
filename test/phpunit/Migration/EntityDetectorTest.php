<?php
namespace Gt\Orm\Test\Migration;

use Gt\Orm\Migration\EntityDetector;
use Gt\Orm\Test\TestProjectRoot\class\NestedNamespace\TestNestedClass;
use Gt\Orm\Test\TestProjectRoot\class\NotAnEntity;
use Gt\Orm\Test\TestProjectRoot\class\RootClass;
use PHPUnit\Framework\TestCase;

class EntityDetectorTest extends TestCase {
	public function testGetEntityClassList_noFiles():void {
		$tmpDir = sys_get_temp_dir() . "/phpgt/orm/test/" . uniqid();
		mkdir($tmpDir, recursive: true);
		$sut = new EntityDetector();
		self::assertEmpty($sut->getEntityClassList($tmpDir));
	}

	public function testGetEntityClassList():void {
		$dir = "test/phpunit/TestProjectRoot";
		$sut = new EntityDetector();
		$detected = $sut->getEntityClassList($dir);
		self::assertCount(2, $detected);
		self::assertContains(TestNestedClass::class, $detected);
		self::assertContains(RootClass::class, $detected);
		self::assertNotContains(NotAnEntity::class, $detected);
	}
}
