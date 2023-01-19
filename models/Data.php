<?php

class Data extends Database {

    public static function getData($id) {
        $id = sanitizeInt($id);
        $db = self::connect();

        $stmt = $db->prepare("SELECT * FROM `data` WHERE `id` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $db->close();

        return $data;
    }

    public static function getDataAll() {
        $db = self::connect();
        $sql = "SELECT * FROM data WHERE `parent` != `id` ORDER BY `parent`";
        $result = $db->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        $db->close();

        if ($result) {
            return $data;
        }
        return false;

    }

    public static function getDataChildrenById($parentId = 0) {
        $parentId = sanitizeInt($parentId);

        $db = self::connect();
        $stmt = $db->prepare("SELECT * FROM `data` WHERE `parent` = ?");
        $stmt->bind_param("i", $parentId);
        $stmt->execute();

        $result = $stmt->get_result();
        $children = $result->fetch_all(MYSQLI_ASSOC);
        
        $db->close();

        return $children;
    }

    public static function storeData($name, $description = null, $parent = 0) {
        $name = sanitizeString($name);
        $description = sanitizeString($description);
        $parent = sanitizeInt($parent);

        $db = self::connect();
        $stmt = $db->prepare("INSERT INTO `data` (`name`, `description`, `parent`) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $name, $description, $parent);
        $stmt->execute();
        $db->close();

        return;
    }
    
    public static function deleteData($id) {
        $id = sanitizeInt($id);

        $db = self::connect();
        $stmt = $db->prepare("DELETE FROM `data` WHERE `id` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $db->close();

        $children = self::getDataChildrenById($id);
        if(!empty($children)) {
            foreach ($children as $child) {
                self::deleteData($child['id']);
            }
        }

        return;
    }

    public static function updateData ($id, $name, $description, $parent = 0) {
        $id = sanitizeInt($id);
        $name = sanitizeString($name);
        $description = sanitizeString($description);
        $parent = sanitizeInt($parent);

        $db = self::connect();
        $stmt = $db->prepare("UPDATE `data` SET `name`=?, `description`=?, `parent`=? WHERE `id`=?");
        $stmt->bind_param("ssii", $name, $description, $parent, $id);
        $stmt->execute();
        $db->close();

        return;
    }
}