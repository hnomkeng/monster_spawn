<?php
function mapImage($mapName, $small = false)
{
    $link = FLUX_DATA_DIR . '/maps/map/' . $mapName . '.png';
    $path = FLUX_ROOT . '/' . $link;
    return file_exists($path) ? $link : false;
}
function npcImage($id)
{
    $link = FLUX_DATA_DIR . '/NPCs/' . $id . '.gif';
    $path = FLUX_ROOT . '/' . $link;
    return file_exists($path) ? $link : false;
}

class FileLoad{

    protected $path;
    protected $errorCodeMessages = array(
        1 => 'ไฟล์ที่อัพโหลดเกินกว่าคำสั่ง upload_max_filesize ใน php.ini',
        2 => 'ไฟล์ที่อัปโหลดเกินคำสั่ง MAX_FILE_SIZE ที่ระบุในรูปแบบ HTML',
        3 => 'ไฟล์ที่อัพโหลดถูกอัพโหลดเพียงบางส่วนเท่านั้น',
        4 => 'ไม่มีการอัปโหลดไฟล์',
        6 => 'ไม่มีโฟลเดอร์ชั่วคราว',
        7 => 'การเขียนไฟล์ลงดิสก์ไม่สำเร็จ',
        8 => 'นามสกุล PHP หยุดอัพโหลดไฟล์'
    );

    public function load($file, $path){
        $this->path = $path;
        if($file->get('error')){
            return $this->errorCodeMessages[$file->get('error')];
        }
        if(is_uploaded_file($file->get('tmp_name'))) {
            if(move_uploaded_file($file->get('tmp_name'), $path)) {
                return true;
            }
        }
        return 'ในระหว่างที่เกิดข้อผิดพลาดไฟล์บูต';
    }

    public function delete(){
        unlink($this->path);
    }
}