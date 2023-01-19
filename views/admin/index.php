<?php
    $css = "/public/css/admin-index.css";
    require_once(BASEURL . "/views/admin/header.php");
?>
    <main>
        <h1 class="header">Data Structure</h1>
        <div class="container data-section">
            <?php echo $vars['data']; ?>
        </div>

        <hr>

        <div class="edit-section">
            <div class="add-data">
                <h2 class="header">Adding</h2>
                <div class="add-control">
                    <form action="/admin/data/add" method="POST">
                        <label for="name">Name</label>
                        <input type="text" name="name" required >
                        
                        <label for="description">Description</label>
                        <textarea name="description"cols="30" rows="10"></textarea>

                        <label for="parent">Parent</label>
                        <select name="parent">
                            <option value="0">Root Element</option>
                            <?php 
                                foreach($vars['datas'] as $data){
                                    $id = $data['id'];
                                    $name = $data['name'];
                                    echo "<option value='{$id}'>{$name}</option>";
                                }
                            ?>
                        </select>

                        <input type="submit" value="Add data">
                    </form>
                </div>
            </div>

            <div class="edit-data">
                <h2 class="header">Editing</h2>

                <form action="/admin/data/edit" method="POST">
                    <label for="name">Select Data</label>
                    <select name="data">
                        <?php 
                            foreach($vars['datas'] as $data){
                                $id = $data['id'];
                                $name = $data['name'];
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        ?>
                    </select>

                    <label for="name" required>Name</label>
                    <input type="text" name="name">
                    
                    <label for="description">Description</label>
                    <textarea name="description"cols="30" rows="10"></textarea>

                    <label for="parent">Select Parent</label>
                    <select name="parent">
                        <option value="0">Root Element</option>
                        <?php 
                            foreach($vars['datas'] as $data){
                                $id = $data['id'];
                                $name = $data['name'];
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        ?>
                    </select>

                    <input type="submit" value="Edit data">
                </form>
            </div>

            <div class="delete-data">
                <h2 class="header">Deleting</h2>
                <form action="/admin/data/delete" method="POST">
                    <label for="name">Select Data</label>
                    <select name="data">
                        <?php 
                             foreach($vars['datas'] as $data){
                                $id = $data['id'];
                                $name = $data['name'];
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        ?>
                    </select>

                    <input type="submit" value="Delete data">
                </form>
            </div>
        </div>
    </main>
<?php
    require_once(BASEURL . "/views/admin/footer.php");
?>