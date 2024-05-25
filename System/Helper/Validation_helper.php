<?php

function replaceErrors($output)
{
    // Pattern untuk menemukan @error('key') ... @enderror
    $pattern = '/@error\((.*?)\)(.*?)@enderror/s';

    // Periksa apakah ada validasi error di sesi
    if (session_has_validation('errors') === true) {
        $session_error = session_get_flash('errors');

        // Cari semua pola yang cocok
        preg_match_all($pattern, $output, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $errorVariable = trim($match[1], "\t\n\r\0\x0B'\"");
            $errorContent = trim($match[2]);
            $errorNew = "";

            // Loop melalui semua error di sesi
            if (is_array($session_error) && array_key_exists($errorVariable, $session_error)) {
                foreach ($session_error[$errorVariable] as $val) {
                    $errorNew .= "<span class=\"text-danger\">{$val}</span>";
                }
            }

            // Ganti placeholder $message dengan pesan error yang ditemukan atau konten asli jika tidak ditemukan
            if ($errorContent === '{{$message}}') {
                $output = str_replace($match[0], $errorNew, $output);
            } else {
                $output = str_replace($match[0], $errorContent, $output);
            }
        }
        clear_old_input();
    }

    return $output;
}
