<?php
date_default_timezone_set('Asia/Kolkata');
include('configclasssub.php');
?>
    <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 435px;block-size: fit-content;" role="document">
            <div class="modal-content" >
                <div class="modal-header text-center">
                    <div class="row justify-content-md-center mb-4"  >
                        <div class="col-md-12">
                            <!--start code-->

                            <div class="card-body messages-box">
                                <ul class="list-unstyled messages-list">
                                    <?php
                                    $res = mysqli_query($con, "select * from message");
                                    if (mysqli_num_rows($res) > 0) {
                                        $html = '';
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $message = $row['message'];
                                            $added_on = $row['added_on'];
                                            $strtotime = strtotime($added_on);
                                            $time = date('h:i A', $strtotime);
                                            $type = $row['type'];
                                            if ($type == 'user') {
                                                $class = "messages-me";
                                                $imgAvatar = "user_avatar.png";
                                                $name = "Me";
                                            } else {
                                                $class = "messages-you";
                                                $imgAvatar = "bot_avatar.png";
                                                $name = "Chatbot";
                                            }
                                            $html .= '<li class="' . $class . ' clearfix"><span class="message-img"><img src="images/' . $imgAvatar . '" class="avatar-sm rounded-circle" style="width:20px;height:20px;"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">' . $name . '</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' . $time . '</span></small> </div><p class="messages-p">' . $message . '</p></div></li>';
                                        }
                                        echo $html;
                                    } else {
                                    ?>
                                        <li class="messages-me clearfix start_chat">
                                            Please start
                                        </li>
                                    <?php
                                    }
                                    ?>

                                </ul>
                            </div>
                            <div class="card-header">
                                <div class="md-form">
                                    <i class="fas fa-pencil prefix grey-text"></i>
                                    <textarea type="text" id="input-me" class="md-textarea form-control input-sm" rows="3" placeholder="Type your message here!...." name="messages"></textarea>
                                    <label data-error="wrong" data-success="right" for="form8"></label>
                                </div>
                                <span class="input-group-append">
                                    <input type="button" class="btn btn-primary" value="Send" onclick="send_msg()">
                                </span>

                            </div>
                            <!--end code-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <br>
    <div class="buts">
        <button data-toggle="modal" data-target="#modalContactForm" style="background-color:rgba(0, 0, 0, 0);border-width:0px;">
           <img src="images/bot_avatar.png" width="65">
        </button>
    </div>
    <br>
    <script type="text/javascript">
        function getCurrentTime() {
            var now = new Date();
            var hh = now.getHours();
            var min = now.getMinutes();
            var ampm = (hh >= 12) ? 'PM' : 'AM';
            hh = hh % 12;
            hh = hh ? hh : 12;
            hh = hh < 10 ? '0' + hh : hh;
            min = min < 10 ? '0' + min : min;
            var time = hh + ":" + min + " " + ampm;
            return time;
        }

        function send_msg() {
            jQuery('.start_chat');
            var txt = jQuery('#input-me').val();
            var html = '<li class="messages-me clearfix"><span class="message-img"><img src="images/user_avatar.png" class="avatar-sm rounded-circle" style="width:20px;height:20px;"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p">' + txt + '</p></div></li>';
            jQuery('.messages-list').append(html);
            jQuery('#input-me').val('');
            if (txt) {
                jQuery.ajax({
                    url: 'get_bot_message.php',
                    type: 'post',
                    data: 'txt=' + txt,
                    success: function(result) {
                        var html = '<li class="messages-you clearfix"><span class="message-img"><img src="images/bot_avatar.png" class="avatar-sm rounded-circle" style="width:20px;height:20px;"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p">' + result + '</p></div></li>';
                        jQuery('.messages-list').append(html);
                        jQuery('.messages-box').scrollTop(jQuery('.messages-box')[0].scrollHeight);
                    }
                });
            }
        }
    </script>
    <style>
        #id {
            width: 500px;
        }

        #chatting {
            width: 500px;
        }

        .buts {
            display: flex;
            flex-direction: column;
            justify-content: end;
            align-items: flex-end;
            float: right;
            position: absolute;
            right:0px;
            bottom:0px;
            background-attachment: fixed;
            overflow: hidden;
            
        }
        .buts button{
            position: fixed;
            background-attachment: fixed;
            overflow: hidden;
        }
    </style>
    <script>

    </script>