<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileImageController extends Controller
{
    public function updateProfileImage(Request $request)
    {
        if ($request->hasFile('profileImage')) {
            // 获取上传的文件
            $file = $request->file('profileImage');
            
            $filePath = $file->store('profile_images', 'public');
            
            // 返回文件路径，你可以根据实际需要返回其他数据
            return response()->json(['success' => true, 'filePath' => $filePath]);
        }
        
        return response()->json(['success' => false, 'message' => 'No file uploaded.']);
    }
}
