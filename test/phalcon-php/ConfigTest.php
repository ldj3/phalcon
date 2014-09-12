<?php
/**
 * Config Testsuite
 *
 * @author Wenzel Pünter <wenzel@phelix.me>
*/
class ConfigTest extends BaseTest
{
	public function testArraySimple()
	{
		$config = new \Phalcon\Config(array(
			'database' => array(
				'adapter' => 'Mysql',
				'host' => 'localhost',
				'username' => 'scott',
				'password' => 'cheetah',
				'dbname' => 'test_db',
			),
     		'app' => array(
        		'controllersDir' => '../app/controllers/',
        		'modelsDir' => '../app/models/',
        		'viewsDir' => '../app/views/',
    		),
    		'mysetting' => 'the-value'
    	));

		$this->assertEquals(isset($config->app->controllersDir), true);
		$this->assertEquals(isset($config->notExistingProperty), false);
		$this->assertEquals(isset($config['app']['controllersDir']), true);
		$this->assertEquals(isset($config['mysetting']), true);
		$this->assertEquals($config->offsetExists('mysetting'), true);

    	$this->assertEquals($config->app->controllersDir, '../app/controllers/');
    	$this->assertEquals($config['app']['controllersDir'], '../app/controllers/');
    	$this->assertEquals($config['notExistingProperty'], null);

    	$this->assertEquals($config->mysetting, $config->get('mysetting'));
    	$this->assertEquals($config['mysetting'], $config->mysetting);
	}

	public function testArrayExtended()
	{
		$config = new \Phalcon\Config(array());

		$config['boolTrue'] = true;
		$this->assertEquals($config->offsetExists('boolTrue'), true);
		$this->assertEquals(isset($config['boolTrue']), true);
		$this->assertEquals(isset($config->boolTrue), true);
		$this->assertEquals($config['boolTrue'], true);
		$this->assertEquals($config->boolTrue, true);
		$this->assertEquals($config->get('boolTrue'), true);
		$this->assertEquals($config->offsetGet('boolTrue'), true);

		$config->offsetUnset('boolTrue');
		$this->assertEquals(isset($config['boolTrue']), false);
		$this->assertEquals($config['boolTrue'], null);

		$this->assertEquals($config->toArray(), array());
		$this->assertEquals($config->count(), 0);

		$config->a = 'b';
		$this->assertEquals($config->toArray(), array(
			'a' => 'b'
		));

		$anotherConfig = new \Phalcon\Config(array('test' => 'data'));
		$config['config'] = $anotherConfig;
		$this->assertEquals($config->toArray(), array(
			'a' => 'b',
			'config' => array(
				'test' => 'data'
			)
		));

		unset($config->a);
		$this->assertEquals($config->count(), 1);
	}

	public function testMerge()
	{
		//Simple merge
		$configA = new \Phalcon\Config(array(
			'a' => 'b',
			'c' => array('d', 'e')
		));
		$configB = new \Phalcon\Config(array(
			'c' => 'f',
			'g' => 'h'
		));
		$configA->merge($configB);

		$this->assertEquals($configA->toArray(), array(
			'a' => 'b',
			'c' => 'f',
			'g' => 'h'
		));

		//Inherited merge
		$configC = new \Phalcon\Config(array(
			'a' => new \Phalcon\Config(array(
				'b' => 'c'
			))
		));

		$configD = new \Phalcon\Config(array(
			'a' => new \Phalcon\Config(array(
				'd' => 'e'
			)),
			'f' => new \Phalcon\Config(array(
				'g' => 'h'
			))
		));
		$configC->merge($configD);

		$this->assertEquals($configC->toArray(), array(
			'a' => array(
				'b' => 'c',
				'd' => 'e'
			),
			'f' => array(
				'g' => 'h'
			)
		));
	}

	public function testSetState()
	{
		$config = new \Phalcon\Config(array(
			'a' => 'b'
		));
		$configCopy = \Phalcon\Config::__set_state($config->toArray());
		$this->assertEquals($configCopy->toArray(), $config->toArray());
	}

	public function testConstructorException()
	{
		$this->setExpectedException('\Phalcon\Config\Exception');
		$config = new \Phalcon\Config(false);
	}

	public function testExceptions()
	{
		$config = new \Phalcon\Config(array());

		$this->assertException(
			array($config, 'offsetExists'),
			array(new \stdClass()),
			'Phalcon\Config\Exception');

		$this->assertException(
			array($config, 'get'), 
			array(array('Invalid Data')),
			'Phalcon\Config\Exception');

		$this->assertException(
			array($config, 'offsetSet'), 
			array(new \stdClass(), 'Valid Data'),
			'Phalcon\Config\Exception');

		$this->assertException(
			array($config, 'offsetUnset'), 
			array(array('Invalid Data')),
			'Phalcon\Config\Exception');

		$this->assertException(
			array($config, 'merge'), 
			array(true),
			'Phalcon\Config\Exception');
	}
}