<?php
    //store user profile image function
    function storeProfileImage($image){
        $imageName=time().uniqid().$image->getClientOriginalName();
        $image->storeAs('public/images/profile_images',$imageName);
        return $imageName;
    }

    //store pizza pictures function
    function storePizzaPicture($product){
        $productName=time().uniqid().$product->getClientOriginalName();
        $product->storeAs('public/images/pizza_images',$productName);
        return $productName;
    }
?>
