<?php

$mysqli = new msqli('localhost', 'root', '', 'buddy') or die (mysqli_error($mysqli));
$result = $mysqli -> query("SELECT users.id, 
                                    profile.name,
                                    survey_answer.cleanliness_level,
                                    survey_answer.entertainment,
                                    survey_answer.friendship,
                                    survey_answer.friend_over,
                                    survey_answer.privacy,
                                    survey_answer.religious_beliefs,
                                    survey_answer.same_course,
                                    survey_answer.sharing,
                                    survey_answer.sleep_schedule,
                                    survey_answer.study_mate,
                            FROM    ((users
                            INNER JOIN  profile ON users.id = users.id");
                            INNER JOIN  survey_answer ON profile.user_id = users.id");

?>