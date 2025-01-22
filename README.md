# WordPress Functionality

Welcome to the **WordPress Functionality** repository! This repository contains a collection of code snippets, scripts, and utilities designed to enhance and implement specific features and functionality in WordPress websites. Whether you're a developer looking for quick solutions or exploring ideas for custom functionality, this repository is here to help.

---

## Repository Structure

The repository is organized as follows:

- **Code Snippets:** Small, reusable code blocks to extend or modify WordPress functionality.
- **Scripts:** Custom scripts for handling specific tasks or automations in WordPress.
- **Plugins (if applicable):** Complete plugin files that can be installed and activated.
- **Utilities:** Helper functions and classes to simplify development workflows.

---

## Current Folders

### Hreflang

#### 1. `dynamic-hreflang-attributes-single-lang.php`
This script helps dynamically set hreflang attributes for multilingual WordPress websites. It ensures correct search engine indexing and improves SEO for sites targeting multiple languages or regions.

**Key Features:**
- Automatically generates hreflang tags based on site configuration.
- Ensures proper linking between translated pages.
- Enhances SEO performance for multilingual websites.

#### 2. `dynamic-hreflang-attributes-multi-lang.php`
This script dynamically generates hreflang attributes for multilingual WordPress websites where different languages are hosted under specific URL structures (e.g., /en, /fr, /de). It ensures reciprocal hreflang links between all translated versions of a page, complying with Google’s guidelines for multi-language SEO.

**Key Features:**
- Automatically generates hreflang tags for each supported language.
- Supports the root domain (https://example.com) for the default language (e.g., en).
- Handles languages with distinct URL structures, such as /fr for French or /de for German.
- Ensures hreflang annotations include links to all alternate page versions, solving common "missing return link" errors.
- Includes x-default hreflang for global fallback when no language preference is detected.

---

## Getting Started

To use the snippets and scripts:

1. Clone the repository:
   ```bash
   git clone https://github.com/web-lifter/wordpress-functionality.git
   ```

2. Add the desired code snippet or script to your WordPress theme or plugin.

3. Follow the usage instructions provided in the respective file's comments.

---

## Contributions

We welcome contributions! Please follow these steps to contribute:

1. Fork the repository.
2. Create a new branch: `git checkout -b feature-branch-name`
3. Make your changes and commit them: `git commit -m 'Add new feature'`
4. Push to the branch: `git push origin feature-branch-name`
5. Submit a pull request.

---

## Suggestions and Issues

If you have ideas for new functionality or encounter any issues with the existing code, please open an issue in this repository. Your feedback helps us improve and expand this resource.

---

## Requirements

- WordPress version: 5.0 or higher.
- PHP version: 7.4 or higher.

---

## License

This repository is licensed under the [MIT License](LICENSE). Feel free to use, modify, and distribute the code in accordance with the license terms.

---

## Author

This repository is maintained by **[Web Lifter]**. If you have any questions or need support, feel free to reach out!

---

## Contact

For any questions or inquiries, please contact [open-source@weblifter.com.au](mailto:open-source@weblifter.com.au).

---

Thank you for visiting the **WordPress Functionality** repository. Happy coding! 🎉


