<?php
namespace LaunchpadRendererTakeOff\Tests\Integration\inc\Commands\InstallCommand;

use LaunchpadRendererTakeOff\Tests\Integration\TestCase;

class Test_Execute extends TestCase
{
    /**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected($config, $expected) {
        foreach ($config['files'] as $path => $file) {
            $this->assertSame($file['exists'], $this->filesystem->exists($path),  $file['exists'] ? "$path should exists" : "$path should not exists");
            if($file['exists']) {
                $this->assertSame($file['content'], $this->filesystem->get_contents($path), "$path should have same content");
            }
        }
        $this->launch_app("renderer:install{$config['parameters']}");

        foreach ($expected['files'] as $path => $file) {
            $this->assertSame($file['exists'], $this->filesystem->exists($path),  $file['exists'] ? "$path should exists" : "$path should not exists");
            if($file['exists']) {
                $this->assertSame($file['content'], $this->filesystem->get_contents($path), "$path should have same content");
            }
        }
    }
}