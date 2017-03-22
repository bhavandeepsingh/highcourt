<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

/*
 *  These are the static variable for the user permissions 
 */

/* 
 * permissions belong to user for delete posts
 */
define("USER_CAN_DELETE_POSTS","deletePost");
define("USER_CAN_UPDATE_POSTS","updatePost");
define("USER_CAN_CREATE_POSTS","createPost");