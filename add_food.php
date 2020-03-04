<?php
//check if log in and logged in user can add food or not
require('inc/auth.php');
if ($user['role_id'] < 1 || $user['role_id'] > 2) {
    header('location: index.php');
}


include('inc/header.php');
//getCategories function is defined on inc/db.php file, returns categories in array..
$categories = getCategories();
if (isset($_POST['submit'])) {
    $error = false;
    $messages = array();
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $other_category = $_POST['other_category'];
    $price = $_POST['price'];
    $components = $_POST['components'];
    $image = $_POST['image'];
    // var_dump($_POST);
    // exit;
    // if 'create new category' is selected and new category text field is filled
    if ($category_id == -1) {
        if ($other_category == null || strlen($other_category) == 0) {
            array_push($messages, 'Please select category or add new category in text field');
            $error = true;
        }
    }
    //check if price is numeric
    if (!is_numeric($price)) {
        array_push($messages, 'Please enter numeric value for price.');
        $error = true;
    }

//validation for file uploads
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check == false) {
        array_push($messages, 'Uploaded file is not an image');
        $error = true;
    }

    //move uploaded image
    $image = 'food_image' . rand(1, 5000).end((explode(".", $_FILES["image"]["name"])));
    $target_file = "uploads/" . $image;
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    } else {
        array_push($messages, "Sorry, there was an error uploading your file.");
        $error = true;
    }


    if (!$error) {
        //add category first
        if ($category_id == -1)
            $category_id = addNewCategory($other_category);
           //addNewCategory is defined in inc/db.php adds category and return id of new category

        $query = "insert into foods(name,description,price,category_id,components,image) values('$name','$description','$price','$category_id','$components','$image')";
        $r = $dbconnection->query($query);
        if ($r) {
            $success = "Successfully added a food item";
        } else {
            array_push($messages, 'Failed to add food item');
            $error = true;
        }
    }
}
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add new food item</div>
                <div class="card-body">
                    <?php if ($error = true && isset($messages)) : ?>
                        <?php foreach ($messages as $message) : ?>
                            <div class="alert alert-danger">
                                <?php echo $message; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (isset($success)) : ?>
                        <div class="alert alert-primary">
                            <?php echo $success; ?>
                        </div>
                    <?php endif; ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="Name">Name of food item</label>
                            <input type="text" required value='' name='name' class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="Name">Description of food item</label>
                            <textarea name='description' required class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="Name">Category of food item</label>
                            <div class="row justify-content-between">
                                <div class="col-md-4">
                                    <select name="category_id" class='form-control'>
                                        <option value="-1">Create new category</option>
                                        <?php foreach ($categories as $category) : ?>
                                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <span class='text-large'>if create new category selected </span>
                                </div>
                                <div class="col-md-5">
                                    <input class='form-control' type="text" placeholder="Enter category name here." name='other_category'>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Name">Price of food item</label>
                            <input type="text" value='' required name='price' class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="Name">Components of food item</label>
                            <input type="text" value='' required name='components' class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="Name">Image of food item</label>
                            <input type="file" name='image' required class="form-control-file">
                        </div>

                        <button type='submit' name='submit' class='btn btn-primary'>Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


<?php include('inc/footer.php'); ?>