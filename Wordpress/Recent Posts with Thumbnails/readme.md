This custom WordPress functionality allows you to display recent posts with thumbnails using a simple shortcode. The feature includes customizable attributes such as the number of posts, category filtering, and thumbnail size.

How to Use

Step 1: Add the Code

Copy the provided PHP code into your WordPress theme's functions.php file.

Step 2: Use the Shortcode

Add the following shortcode to any post, page, or widget:

[recent_posts posts_per_page="5" category="news" show_date="true" thumbnail_size="medium"]

Shortcode Attributes

posts_per_page (optional): The number of posts to display (default: 5).

category (optional): Filter posts by category slug (default: none).

show_date (optional): Show the post date (true or false, default: true).

thumbnail_size (optional): Specify the WordPress image size (e.g., thumbnail, medium, large; default: thumbnail).

Styling

You can customize the appearance by adding the provided CSS to your theme's stylesheet. The CSS styles the list of posts, including the thumbnails, titles, and optional dates.

Example CSS

Here is a basic CSS template for styling:

.recent-posts-thumbnails {
    list-style: none;
    padding: 0;
    margin: 0;
}

.recent-post-item {
    display: flex;
    align-items: center;
    margin-bottom: 1em;
}

.recent-post-thumbnail {
    margin-right: 1em;
    flex-shrink: 0;
}

.recent-post-thumbnail img {
    border-radius: 8px;
    width: 75px;
    height: 75px;
    object-fit: cover;
}

.recent-post-content {
    display: flex;
    flex-direction: column;
}

.recent-post-title {
    font-size: 1rem;
    font-weight: bold;
    color: #0073aa;
    text-decoration: none;
    margin-bottom: 0.2em;
}

.recent-post-title:hover {
    text-decoration: underline;
}

.post-date {
    font-size: 0.85rem;
    color: #555;
}

Notes

Ensure your theme supports thumbnails by enabling add_theme_support('post-thumbnails'); if not already enabled.

Avoid adding the code to the functions.php file of a parent theme if you expect theme updates, as it may overwrite the changes. Instead, use a child theme.

Contribution

Feel free to modify and expand this code to suit your specific needs. Contributions and suggestions are welcome!