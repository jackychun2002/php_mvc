<?php
    interface modelP{
        public function allList();
        public function save(array $data);
        public function update(array $data, $id);
        public function delete($id);
    }
