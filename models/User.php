<?php
namespace app\models;
use Yii;
use yii\base\Security;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public $password_confirmed;
    public static function tableName()
    {
        return '{{%tbl_user}}';
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


     public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'email', 'password', 'password_confirmed'], 'required'],
            // rememberMe must be a boolean value
            // ['password', 'boolean'],
            // password is validated by validatePassword()
            ['password_confirmed', 'compare','compareAttribute'=>"password"],
        ];
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool|null if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password){
        return $this->password===md5($password);
    }
    public static function findByUsername($username){
        return User::findOne(["username"=>$username]);
    }

    public function beforeSave($insert){
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key=\yii::$app->security->generateRandomString();
            }
            if (isset($this->password)) {
                $this->password=md5($this->password);
                return parent::beforeSave($insert);
            }

        }
        return true;
    }
}