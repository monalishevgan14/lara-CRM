<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Product Created</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">

    <div style="background: #ffffff; padding: 20px; border-radius: 8px; max-width: 600px; margin: auto;">
        
        <h2 style="color: #333;">🛒 New Product Created</h2>

        <p>A new product has been added to your system.</p>

        <hr>

        <p><strong>Product Name:</strong> {{ $product->name }}</p>
        <p><strong>Price:</strong> ₹{{ $product->price }}</p>
        <p><strong>Stock:</strong> {{ $product->stock }}</p>

        <hr>

        <p style="color: #777; font-size: 14px;">
            This is an automated email from your Laravel CRM system.
        </p>

    </div>

</body>
</html>
