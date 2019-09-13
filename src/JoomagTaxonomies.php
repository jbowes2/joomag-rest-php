<?php

namespace Joomag;

class JoomagTaxonomies {
    private $joomagCategoryIdToNameMap = [
        6 => "General",
        7 => "Pro Sports",
        8 => "Automotive",
        9 => "World",
        11 => "Fashion",
        12 => "Boating & Aviation",
        13 => "Design",
        15 => "Science",
        19 => "History",
        21 => "Adult",
        22 => "Hunting & Fishing",
        24 => "Education",
        26 => "Gaming",
        29 => "Football",
        30 => "Health & Fitness",
        36 => "Music",
        39 => "Politics",
        40 => "Religion & Spirituality",
        41 => "Lifestyle",
        42 => "Teen",
        43 => "Art",
        44 => "Motorcycles",
        47 => "Business",
        48 => "Children's",
        65 => "Photography",
        67 => "Cycling",
        70 => "Trucks",
        82 => "Personal Finance",
        88 => "Wine & Spirits",
        89 => "Food & Cooking",
        90 => "Home Decor",
        94 => "Literary",
        97 => "Celebrity & Gossip",
        98 => "Television",
        99 => "Ethnic & Culture",
        106 => "Health & Fitness",
        108 => "Crafts",
        114 => "Architecture",
        116 => "Gardening",
        121 => "Real Estate",
        123 => "Vacation",
        130 => "Outdoor",
        140 => "Family & Parenting",
        148 => "Nature",
        150 => "Winter Sports",
        152 => "College Sports",
        156 => "Bridal & Weddings",
        157 => "Beauty",
        174 => "Hockey",
        184 => "Golf & Tennis",
        185 => "Hobbies",
        186 => "Web & Computing",
        187 => "Pets & Animals",
        188 => "Cars-Specialty",
        189 => "Off-Road",
        191 => "Urban",
        192 => "Footwear",
        193 => "Accessories",
        194 => "Jewelry",
        195 => "Trends",
        196 => "Alternative",
        197 => "Local & Regional",
        198 => "Movies",
        199 => "Gay & Lesbian",
        200 => "Luxury",
        201 => "Shopping",
        202 => "Lifestyle",
        203 => "Causes & Social Interests",
        204 => "Celebrity & Gossip",
        205 => "Trade",
        206 => "Boards",
        207 => "Ocean Sports",
        210 => "Romance",
    ];

    private $joomagMagazineTypeIdToNameMap = [
        1 => "Magazine",
        2 => "Catalogue",
        3 => "Photo Album",
        4 => "E-Book",
        5 => "E-Card",
        6 => "Article",
        7 => "Essay",
        8 => "Journal",
        9 => "Manual",
        10 => "Newspaper",
        11 => "Paper",
        12 => "Portfolio",
        13 => "Report",
        14 => "Other",
        15 => "Brochure",
        16 => "Comics",
    ];

    public function getCategoryIdToNameMap(): array
    {
        return $this->joomagCategoryIdToNameMap;
    }

    public function getCategoryNameById(int $id): ?string
    {
        return $this->joomagCategoryIdToNameMap[$id] ?? null;
    }

    public function getMagazineTypeIdToNameMap(): array
    {
        return $this->joomagMagazineTypeIdToNameMap;
    }

    public function getMagazineTypeNameById(int $id): ?string
    {
        return $this->joomagMagazineTypeIdToNameMap[$id] ?? null;
    }
}
