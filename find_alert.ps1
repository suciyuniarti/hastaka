$files = Get-ChildItem -Path 'd:/xampp/htdocs/hastaka/application/views' -Recurse -Include *.php
foreach ($f in $files) {
    $lineNum = 0
    Get-Content $f.FullName | ForEach-Object {
        $lineNum++
        if ($_ -match 'alert\s*\(') {
            $rel = $f.FullName.Replace('d:/xampp/htdocs/hastaka/', '')
            Write-Output ("{0}:{1}: {2}" -f $rel, $lineNum, $_.Trim())
        }
    }
}
