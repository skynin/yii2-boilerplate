<?php

namespace common\tests\unit\models;

use common\models\User;
use common\fixtures\UserFixture;

/**
 * Description of ExtInfoTest
 *
 * @author Skynin <sohay_ua@yahoo.com>
 * created: 06-May-2018
 */
class ExtInfoTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

	protected $userName = 'bayer.hudson';


    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ];
    }

	protected function getUser() {
		return User::findOne(['username' => $this->userName]);
	}

    public function testExtInfoTrait()
    {
		$user = $this->getUser();

		$user->joSet('nickName', 'testNick');
		$user->save();

		$user = $this->getUser();

		$this->assertEquals($user->joGet('nickName'), 'testNick');
    }

	public function testExtInfoQuery()
	{
		$user = $this->getUser();
		$user->joSet('nickName', 'testNick');
		$user->joSet('money',['balance' => 100]);
		$user->save();

		$echoSQL = false;

		$this->assertEquals(User::find()->joWhere(['nickName'=>'testNick'])->one()->id, $user->id);

		$this->assertEquals($this->activeQuery(User::find()->joWhere(['>', 'money.balance', 50]),$echoSQL)->one()->id, $user->id);
		$this->assertEmpty($this->activeQuery(User::find()->joWhere(['<', 'money.balance', 50]),$echoSQL)->one());

		$this->assertNotEmpty($this->activeQuery(User::find()->joWhere(['is', 'nullValue', 'null']), $echoSQL)->one());
		$this->assertNotEmpty($this->activeQuery(User::find()->joWhere(['is', 'nickName', 'not null']), $echoSQL)->one());
	}

	protected function activeQuery( $query, $echo = false )
	{
		if ($echo) {
			$queryTest = $query;
			$this->outputConsole($queryTest->createCommand()->sql);
		}

		return $query;
	}

	use \common\tests\OutputConsoleTrait;
}
