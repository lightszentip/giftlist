<?php
class PresentModel {
    protected $id;
    protected $title;
    protected $imagePath;
    protected $description;
    protected $status;
    protected $code;
    protected $links;

    public function __construct($dic = "") {
        if (!empty($dic)) {
            $this -> id = $dic[PresentDao::COLUMN_ID];
            $this -> title = $dic[PresentDao::COLUMN_TITLE];
            $this -> imagePath = $dic[PresentDao::COLUMN_IMAGEPATH];
            $this -> description = $dic[PresentDao::COLUMN_DESCRIPTION];
            $this -> status = $dic[PresentDao::COLUMN_STATUS];
            $this -> code = $dic[PresentDao::COLUMN_CODE];
            $this -> links = unserialize($dic[PresentDao::COLUMN_LINKS]);
        }
    }

    public function getId() {
        return $this -> id;
    }

    public function getTitle() {
        return $this -> title;
    }

    public function getImagePath() {
        return $this -> imagePath;
    }

    public function getDescription() {
        return $this -> description;
    }

    public function getStatus() {
        return $this -> status;
    }

    public function getCode() {
        return $this -> code;
    }

    public function getLinks() {
        return $this -> links;
    }

    public function setId($id) {
        $this -> id = $id;
    }

    public function setTitle($title) {
        $this -> title = $title;
    }

    public function setImagePath($imagePath) {
        $this -> imagePath = $imagePath;
    }
    
    public function isImage() {
        return filter_var( $this -> imagePath, FILTER_VALIDATE_URL);
    }

    public function setDescription($description) {
        $this -> description = $description;
    }

    public function setCode($code) {
        $this -> code = $code;
    }

    public function setStatus($status) {
        $this -> status = $status;
    }

    public function setLinks($links) {
        $this -> links = $links;
    }

    public function __toString() {
        return "ID:$this->id -- Titel: '$this->titel' -- Status: ' $this->status'";
    }

    public function getDetails() {
        $ausgabe = '<p><b>' . $this -> getTitle() . '</b></p>
				<p>' . $this -> getDescription() . '
				</p>';
        $split_result = split(';', $this -> getLinks());
        $out_link = "";
        foreach ($split_result as $link) {
            $out_link .= '<a href="' . $link . '" target="_blank">' . $link . '</a><br />';
        }
        $ausgabe .= '<p>' . $out_link . '</p>';
        return $ausgabe;
    }

}
