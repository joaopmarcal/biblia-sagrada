<?php

class Bible extends Connect {

    public static function chooseTestament() {
        $pdo = Connect::getInstance()->getConnection();
        $sql = "SELECT DISTINCT Testament FROM bible";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function chooseBook($testament) {
        $pdo = Connect::getInstance()->getConnection();
        $sql = "SELECT DISTINCT Book FROM bible where Testament='".$testament . "'";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function chooseCharpter($testament, $book) {
        $pdo = Connect::getInstance()->getConnection();
        $sql = "SELECT DISTINCT Chapter FROM bible where Testament='".$testament . "' and Book='".$book . "'";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function chooseVerse($testament,$book,$charpter) {
        $pdo = Connect::getInstance()->getConnection();
        $sql = "SELECT DISTINCT Verse FROM bible where Testament='".$testament . "' and Book='".$book . "' and Chapter='". $charpter ."'";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getText($testament,$book,$charpter) {
        $pdo = Connect::getInstance()->getConnection();
        $sql = "SELECT Text,Verse FROM bible where Testament='".$testament . "' and Book='".$book . "' and Chapter='". $charpter ."'";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
