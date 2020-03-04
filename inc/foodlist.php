<?php 
//this file shows all foods in our hotel in neat html..
require_once('db.php');
require_once('auth.php');

$query = "select * from foods order by 'created_at' asc;";
$result = $dbconnection->query($query);
$foods = array();

if ($result) {
    while (($row = $result->fetch_assoc())) {
        array_push($foods, $row);
    }
}
?>

<?php if (count($foods) == 0) : ?>

    <div class="jumbotron">
        <p>No products added. Please check back later.</p>
        <!-- No food has been found-->
    </div>
<?php else : ?>

    <div class="row justify-content-center">
        <?php foreach ($foods as $food) : ?>
            <div class="col-md-4">
                <div class="card m-1">
                    <img class="card-img-top align-self-center mt-2" style='width:80px' src="/uploads/<?php echo $food['image']; ?>">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $food['name']; ?></h4>
                        <h6 class="card-subtitle mb-2 text-muted">$<?php echo $food['price'];  ?></h6>
                        <a href="/my-cart.php?add=<?php echo $food['id']; ?>" class="card-link">Add to cart <i class="fas fa-shopping-cart"></i> </a>
                        <?php if ($user && $user['role_id']> 0 && $user['role_id']<3) : ?>
                            <a href="#" class="card-link text-primary">Edit</a>
                            <a href="/delete-food.php?id=<?php echo $food['id']; ?>" id class="card-link text-danger">Delete</a>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>