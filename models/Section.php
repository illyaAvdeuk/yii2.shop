<?php 


namespace app\models;
use yii\db\ActiveRecord;

        class Section extends ActiveRecord{
            public static function tableName(){
                return 'section';
            }

            public function getNews(){
                return $this->hasMany(Article::className(), ['section_id' => 'id']);
            }
        }