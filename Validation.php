<?php 
include 'function.php';
class Validation {
    public function userValidation($user,$id = Null){
        $errors = [];
        $function = new functions();
        if(empty($user['first_name'])){
            $errors['first_name'] = 'Please Enter First Name';
        }

        if(empty($user['last_name'])){
            $errors['last_name'] = 'Please Enter Last Name';
        }

        if(empty($user['phone_number'])){
            $errors['phone'] = 'Please Enter Phone Number';
        }
        elseif(!preg_match('/^[0-9]{11}+$/', $user['phone_number'])){
            $errors['phone'] = 'Invalid Phone Number';
        }
        else{
            $conditions = ['phone =' => $user['phone_number']];
            if(!empty($id)){
                $conditions['id != '] = $id;
            }
            // print_r($conditions);die;
            $duplicatePhone= $function->select('user', $conditions);
            // print_r(count($duplicatePhone));die;
            if(count($duplicatePhone) > 0){
                $errors['phone']='Phone Number already exist';
            }
        }
        if(empty($user['email'])){
            $errors['email'] = 'Please Enter Email ID';
        }elseif(!filter_var($user['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Invalid Email ID';
        }else{
            $conditions = ['email =' => $user['email']];
            if(!empty($id)){
                $conditions['id != '] = $id;
            }
            $duplicate= $function->select('user', $conditions);
            if(count($duplicate) > 0){
                $errors['email']='Email already exist';
            }
        }

        if(isset($user['password'])&& isset($user['cpassword'])){
            if(empty($user['password'])){
                $errors['password'] = 'Please Enter Password';
            }
            if(empty($user['cpassword'])){
                $errors['cpassword'] = "Re-enter your password";
            }
            if($user['password'] != $user['cpassword'] && !empty($user['password']) && !empty($user['cpassword']) ){
                $errors['cpassword'] = "Password not matched!";
            }
        }

        
            if(empty($user['user_type_id'])){
                $errors['user_type_id'] = 'Please Select User Type';
        }

        if(empty($user['class_id'])){
            $errors['class_id'] = 'Please Select Class';
    }


        return $errors;
    }

    public function classValidation($user,$id=null){
        $errors = [];
        $function = new functions();
        if(empty($user['class_name'])){
            $errors['class_name'] = 'Please Enter Class Name';
        }else{
            $conditions = ['class_name =' => $user['class_name']];
            if(!empty($id)){
                $conditions['id != '] = $id;
            }       
            $duplicate= $function->select('classes', $conditions);
            // print_r(count($duplicate));die;
            if(count($duplicate) > 0){
                $errors['class_name']='The Class name is already exist';
            }
        }

        return $errors;


    }

    //type validation
    public function typeValidation($user,$id=null){
        $errors = [];
        $function = new functions();
        if(empty($user['name'])){
            $errors['name'] = 'Please Enter the Name';
        }else{
            $conditions = ['name =' => $user['name']];
            if(!empty($id)){
                $conditions['id != '] = $id;
            }       
            $duplicate= $function->select('user_types', $conditions);
            // print_r(count($duplicate));die;
            if(count($duplicate) > 0){
                $errors['name']='This name is already exist';
            }
        }

        return $errors;
    }

   
}

?>
