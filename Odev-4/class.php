<?php
    class TcKimlikKontrol {
        private $tcKimlik;
        private $tekToplam = 0;
        private $ciftToplam = 0;
        private $toplam = 0;
        
        public function TcKontrol ($tcKimlik)
        {
            $this->$tcKimlik = $tcKimlik;
            
            for ($i = 1; $i <= strlen($tcKimlik); $i++)
            {
                if ($i % 2 != 0 && $i != 11)
                    $this->tekToplam += $tcKimlik[$i - 1];
                else if ($i % 2 == 0 && $i != 10)
                    $this->ciftToplam += $tcKimlik[$i - 1];
                if ($i != 11)
                    $this->toplam += $tcKimlik[$i - 1];
                    
            }
            $this->tekToplam *= 7;
            $fark = $this->tekToplam - $this->ciftToplam;
            if (($fark % 10 == $tcKimlik[9]) && ($this->toplam % 10 == $tcKimlik[10]))
                return true;
            else
                return false;
        }
    }
?>