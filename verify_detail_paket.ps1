$file = 'd:\xampp\htdocs\hastaka\application\views\detail_paket.php'
Write-Output '=== alert() occurrences in detail_paket.php ==='
Select-String -Path $file -Pattern 'alert\(' | ForEach-Object {
    Write-Output ($_.LineNumber.ToString() + ': ' + $_.Line.Trim())
}
Write-Output '=== PHP lint ==='
php -l $file
