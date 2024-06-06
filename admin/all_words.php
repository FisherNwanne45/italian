<?php
// Include the database connection file
include 'config.php';

// Include header
include 'header.php';

// Include sidebar
include 'sidebar.php';

// Pagination
$limit = 30;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Sorting
$orderBy = isset($_GET['order_by']) ? $_GET['order_by'] : 'id';
$order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

// Retrieve total number of words
$sqlTotal = "SELECT COUNT(id) AS total FROM words";
$resultTotal = $conn->query($sqlTotal);
$totalWords = $resultTotal->fetch_assoc()['total'];
$totalPages = ceil($totalWords / $limit);

// Retrieve words based on pagination and sorting
$sql = "SELECT id, italian_word, english_translation FROM words ORDER BY $orderBy $order LIMIT $start, $limit";
$result = $conn->query($sql);
?>

<h1>All Words</h1>
<p>Total Word Pairs: <?php echo $totalWords; ?></p>
<div class="row">
    <div class="col-md-6">
        <form action="" method="get" class="form-inline mb-3">
            <label for="order_by" class="mr-2">Sort By:</label>
            <select name="order_by" id="order_by" class="form-control mr-2" onchange="this.form.submit()">
                <option value="id" <?php if ($orderBy === 'id') echo 'selected'; ?>>ID</option>
                <option value="italian_word" <?php if ($orderBy === 'italian_word') echo 'selected'; ?>>Italian Word
                </option>
                <option value="english_translation" <?php if ($orderBy === 'english_translation') echo 'selected'; ?>>
                    English Translation</option>
            </select>
            <select name="order" id="order" class="form-control mr-2" onchange="this.form.submit()">
                <option value="ASC" <?php if ($order === 'ASC') echo 'selected'; ?>>Ascending</option>
                <option value="DESC" <?php if ($order === 'DESC') echo 'selected'; ?>>Descending</option>
            </select>
        </form>
    </div>
</div>

<form id="deleteForm" action="delete_selected_words.php" method="post">
    <button id="deleteBtn" type="button" class="btn btn-danger mb-3" data-toggle="modal" data-target="#deleteModal"><i
            class="fas fa-trash-alt"></i> Delete Selected</button>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Select</th>
                <th>#</th>
                <th>Italian Word</th>
                <th>English Translation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0) {
                $serialNumber = $start + 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='selected_words[]' value='{$row['id']}'></td>";
                    echo "<td>{$serialNumber}</td>";
                    echo "<td>{$row['italian_word']}</td>";
                    echo "<td>{$row['english_translation']}</td>";
                    echo "<td><a href='edit_word.php?id={$row['id']}' class='btn btn-primary'>Edit</a></td>";
                    echo "</tr>";
                    $serialNumber++;
                }
            } else {
                echo "<tr><td colspan='5'>No words found in the database.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</form>

<div class="row">
    <div class="col-md-6">
        <ul class="pagination">
            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
            <?php endfor; ?>
            <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
            </li>
        </ul>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the selected words?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button id="confirmDeleteBtn" type="submit" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
// Handle delete confirmation
document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    document.getElementById('deleteForm').submit();
});
</script>

<?php
// Include footer
include 'footer.php';
?>