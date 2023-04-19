<?php

namespace App\Repositories\AdminRepositories;

use App\Models\ParkingLotComment;
use App\Repositories\Interfaces\AdminInterfaces\ParkingLotCommentRepositoryInterface;

class ParkingLotCommentRepository implements ParkingLotCommentRepositoryInterface
{

    public function showAllComments()
    {
        return ParkingLotComment::all();
    }

}

?>