<?php

namespace SaveUp\Adapters;

interface SourceAdapter {
    public function toBackup();
    public function clean();
}
