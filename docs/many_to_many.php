<?php 

"Model users.php

class Users extends Model    {
   // Relation with messages_user table
      public function messages_user() {
         return $this->hasMany('App\Messages_user','id');
      }
}
Model messages.php

class Messages extends Model    {
   // Relation with messages_user table
      public function messages_user() {
         return $this->hasMany('App\Messages_user','id');
      }
}
Model messages_user.php

 class Messages_user extends Model    {
   // Relation with users table
      public function send_user() {
         return $this->belongsTo('App\Users','user_id');
      }

      public function receive_user() {
         return $this->belongsTo('App\Users','receive_user_id');
      }
     // Relation with messages table
      public function messages() {
         return $this->belongsTo('App\Messages','messages_id');
      }

}
In controller

   public function user_all_messages($id) {
      $data = Messages_user::with('send_user)->with('receive_user')where('user_id',$id)->orWhere('receive_user_id',$id)->get();";