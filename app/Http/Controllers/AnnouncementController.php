<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\announcement;

class AnnouncementController extends Controller
{
    public function Announcement()
    {
        $pengumuman = Announcement::orderBy('tanggal_posting', 'desc')->paginate(10);

        return view('guest.announcement.announcementPage', compact('pengumuman'));
    }
}
