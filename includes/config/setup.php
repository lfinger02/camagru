<?php
include "database.php";


$comments = "CREATE TABLE `comments` (
    `id` int(11) NOT NULL,
    `post_id` int(11) NOT NULL,
    `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `comment_by` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";


$like = "CREATE TABLE `likes` (
    `post_id` int(11) NOT NULL,
    `liked_by` varchar(25) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$insertLike = "INSERT INTO `likes` (`post_id`, `liked_by`) VALUES
(34, 'lfinger'),
(26, 'lfinger');";

$post = "CREATE TABLE `post` (
    `post_id` int(11) NOT NULL,
    `upload_by` varchar(25) NOT NULL,
    `upload_link` varchar(25) NOT NULL,
    `upload_date` varchar(25) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

  $insertPost = "INSERT INTO `post` (`post_id`, `upload_by`, `upload_link`, `upload_date`) VALUES
  (11, 'simple', 'simple_beb4649827', '2019-10-30'),
  (12, 'simple', 'simple_0a26487c31', '2019-10-30'),
  (16, 'admin', 'admin_1f3575a40e', '2019-11-04'),
  (26, 'lovee', 'lovee_2e03f794d0', '2019-11-04'),
  (29, 'lovee', 'lovee_35b1a2eb88', '2019-11-04'),
  (32, 'xxtractz', 'xxtractz_23b6f335ac', '2019-11-05'),
  (34, 'lfinger', 'lfinger_cbb3b5ca41', '2019-11-06');";

$users = "CREATE TABLE `users` (
    `id` int(11) NOT NULL,
    `name` varchar(25) NOT NULL,
    `username` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `email` varchar(25) NOT NULL,
    `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `verified` varchar(10) NOT NULL,
    `mail_preference` varchar(10) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    $insertUsers = "INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `verified`, `mail_preference`) VALUES
    (2, 'Simple', 'simple', 'Simple@simple.com', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', '', ''),
    (3, 'John', 'johnn', 'Lfinger33@gmail.com', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', '', ''),
    (5, 'Admin', 'admin', 'Admin@admin.com', '857b47cfadee1b62e6057c23d3cb880e7d5c5c19edcd95c71d3a0b4a0164c21445d3afa8acecc86099d54c9696db0e5a953634b44b1652fbdf5838bff97f3d4b', '', ''),
    (6, 'Love', 'lovee', 'Love@love.com', '809608a13ba3e304c3e58f851f33f03fd7a17b8e6e64c2477b6d771673aa4c50b04abf789156454b723d660541cf47c899e4ec69d0f0c8dce247f92ee1d8f5a1', 'No', ''),
    (7, 'Lesego', 'lesego', 'Lfinger@gmail.com', 'f77332690c1ca6dd2e70c69c7c19947e93e754ace7a14310861dcabc2ffdb135c9c1db18a76f7aa204bc137ea44f0c27b578affc001ece9ba39abf4b6702fa7f', 'No', ''),
    (8, 'People', 'people', 'Lfinger33@gmail.com', '25c8ca340d245aab33f80b81c75a6b1054160bb8b2a270810c1d8102ed13ca665e9aa6a4d6a296cc42fc3ad3ded329b0ef098e41f65398aac7c55aeffea23f11', 'No', ''),
    (9, 'Peoplee', 'peoplee', 'Lfinger33@gmail.com', '25c8ca340d245aab33f80b81c75a6b1054160bb8b2a270810c1d8102ed13ca665e9aa6a4d6a296cc42fc3ad3ded329b0ef098e41f65398aac7c55aeffea23f11', 'No', ''),
    (10, 'Peoplee', 'peopleee', 'Lfinger33@gmail.com', '25c8ca340d245aab33f80b81c75a6b1054160bb8b2a270810c1d8102ed13ca665e9aa6a4d6a296cc42fc3ad3ded329b0ef098e41f65398aac7c55aeffea23f11', 'No', ''),
    (11, 'Peoplee', 'peopleeee', 'Lfinger33@gmail.com', '25c8ca340d245aab33f80b81c75a6b1054160bb8b2a270810c1d8102ed13ca665e9aa6a4d6a296cc42fc3ad3ded329b0ef098e41f65398aac7c55aeffea23f11', 'No', ''),
    (12, 'Peoplee', 'peopleeeee', 'Lfinger33@gmail.com', '25c8ca340d245aab33f80b81c75a6b1054160bb8b2a270810c1d8102ed13ca665e9aa6a4d6a296cc42fc3ad3ded329b0ef098e41f65398aac7c55aeffea23f11', 'No', ''),
    (13, 'Peoplee', 'peopleeeeee', 'Lfinger33@gmail.com', '25c8ca340d245aab33f80b81c75a6b1054160bb8b2a270810c1d8102ed13ca665e9aa6a4d6a296cc42fc3ad3ded329b0ef098e41f65398aac7c55aeffea23f11', 'No', ''),
    (14, 'Kyle', 'Kyle12', 'Lfinger33@gmail.com', '9e7b419699f1f1e40c400d0a5a2c4882471a5b931c8e218287ea4d8e2e664a780dccc4a09f520209b64b8437c58bfcd8af394edaadcfde6fe3a7fd5ee4cc3dd9', 'Yes', ''),
    (15, 'Imnew', 'Imnew', 'Lfinger33@gmail.com', '1dbd1e974ae6c2f559c17189559185c88711c98c07e9182b83603e383305c502a350166c9db17961a84c13471f291791786ba2d25e4902d91db536d91eb2449b', 'Yes', ''),
    (17, 'badcode', 'xxtractz', 'Musa@mailinator.com', 'cbe0cd68cbca3868250c0ba545c48032f43eb0e8a5e6bab603d109251486f77a91e46a3146d887e37416c6bdb6cbe701bd514de778573c9b0068483c1c626aec', 'No', 'No'),
    (18, 'Lesego', 'lfinger', 'Lfinger33@gmail.com', '9b71d224bd62f3785d96d46ad3ea3d73319bfbc2890caadae2dff72519673ca72323c3d99ba5c11d7c7acc6e14b8c5da0c4663475c2e5c3adef46f73bcdec043', 'Yes', 'Yes');";

    // use exec() because no results are returned
    $conn->exec($comments);
    $conn->exec($like);
    $conn->exec($insertLike);
    $conn->exec($post);
    $conn->exec($insertPost);
    $conn->exec($users);
    $conn->exec($insertUsers);

    ///Extra Configures


    $alterComment = "ALTER TABLE `comments`
    ADD PRIMARY KEY (`id`);
  ";

   $alterPost = "ALTER TABLE `post`
   ADD PRIMARY KEY (`post_id`);";

   $alterUsers = "ALTER TABLE `users`
   ADD PRIMARY KEY (`id`)";

   $modifyComment = "ALTER TABLE `comments`
   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;";

   $modifyPost = "ALTER TABLE `post`
   MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;";

   $modifyUsers = "ALTER TABLE `users`
   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
 COMMIT;";
    
    $conn->exec($alterComment);
    $conn->exec($alterPost);
    $conn->exec($alterUsers);
    $conn->exec($modifyComment);
    $conn->exec($modifyPost);
    $conn->exec($modifyUsers);

    header("Location: ../../index.php");

?>