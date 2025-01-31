<?php

class database{
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "db_madio";
    var $koneksi = "";

    function __construct(){
        $this -> koneksi = mysqli_connect($this->host,$this->username,$this->password,$this->database);
        if (mysqli_connect_error()){
            echo "Koneksi database gagal : ". mysqli_connect_error();
        }
    }

    public function get_data_admin($username){
        $data = mysqli_query($this->koneksi,"SELECT * FROM tb_admin WHERE username = '$username'");

        return $data;
    }

    public function tampil_data_landing(){
        $data = mysqli_query($this->koneksi,"SELECT id_artikel, header, judul_artikel, isi_artikel, status_publish, tba.created_at,
        tba.updated_at, name FROM tb_artikel tba join tb_admin tbu on tba.id_admin = tbu.id_admin where status_publish
        = 'publish'");
        
        if($data){
            if(mysqli_num_rows($data)>0){
                while ($row = mysqli_fetch_array($data)){
                    $hasil[] = $row;
                }
            }else{
                $hasil= '0';
            }            
        }
        
        return $hasil;
    }

    public function tampil_data(){
        $data = mysqli_query($this->koneksi,"SELECT id_artikel, header, judul_artikel, status_publish, tba.created_at,
        tba.updated_at, name FROM tb_artikel tba join tb_admin tbu on tba.id_admin = tbu.id_admin");
        
        if($data){
            if(mysqli_num_rows($data)>0){
                while ($row = mysqli_fetch_array($data)){
                    $hasil[] = $row;
                }
            }else{
                $hasil= '0';
            }            
        }
        
        return $hasil;
    }

    public function tambah_data($header, $judul_artikel, $isi_artikel, $status_publish,$id_admin){
        
        $datetime = date("Y-m-d H:i:s");
        $insert = mysqli_query($this ->koneksi,"INSERT INTO tb_artikel(header, judul_artikel,isi_artikel,status_publish,
        id_admin,created_at)values('$header','$judul_artikel','$isi_artikel','$status_publish','$id_admin','$datetime')");

        return $insert;
    }

    public function get_by_id($id_artikel) {
    $data = mysqli_query($this->koneksi, "SELECT tba.*, tbu.name 
                                          FROM tb_artikel tba 
                                          JOIN tb_admin tbu ON tba.id_admin = tbu.id_admin 
                                          WHERE tba.id_artikel = '$id_artikel'");
    $result = mysqli_fetch_assoc($data);
    return $result;
    }
    
    public function update_artikel($id_artikel, $judul_artikel, $isi_artikel, $status_publish) {
        $query = "UPDATE tb_artikel SET judul_artikel = '$judul_artikel', isi_artikel = '$isi_artikel', 
                  status_publish = '$status_publish' WHERE id_artikel = '$id_artikel'";
        $result = mysqli_query($this->koneksi, $query);
    
        return $result;
    }
    
    function delete_artikel($id_artikel) {
        $query = "DELETE FROM tb_artikel WHERE id_artikel = '$id_artikel'";
        $result = mysqli_query($this->koneksi, $query);
    
        return $result;
    }
    
    
}

?>