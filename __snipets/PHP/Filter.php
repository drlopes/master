<?php

class Filter extends php_user_filter
{
  public $stream;
  public function onCreate()
  {
    $this->stream = fopen('php://temp', 'w+');
    return $this->stream !== false;
  }

  public function filter($in, $out, &$consumed, $closing)
  {
    $output = '';
    while ($bucket = stream_bucket_make_writeable($in))
    {
      $lines = explode("\n", $bucket->data);

      foreach ($lines as $line)
      {
        if (stripos($line, 'parte') !== false)
        {
          $output .= "$line\n";
        }
      }
    }

    $out_bucket = stream_bucket_new($this->stream, $output);
    stream_bucket_append($out, $out_bucket);

    return PSFS_PASS_ON;
  }
}
