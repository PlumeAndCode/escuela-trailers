import React from "react";
import { TouchableOpacity, Text, ActivityIndicator, TouchableOpacityProps } from "react-native";
import { Colors } from "../../constants/colors";

interface ButtonProps extends TouchableOpacityProps {
    title: string;
    variant?: "primary" | "secondary" | "outline" | "danger" | "success";
    size?: "sm" | "md" | "lg";
    loading?: boolean;
    icon?: React.ReactNode;
}

export const Button: React.FC<ButtonProps> = ({
    title,
    variant = "primary",
    size = "md",
    loading = false,
    icon,
    disabled,
    className,
    ...props
}) => {
    const variantClasses = {
        primary: "bg-amber-500 active:bg-amber-600",
        secondary: "bg-slate-700 active:bg-slate-800",
        outline: "bg-transparent border-2 border-amber-500",
        danger: "bg-red-500 active:bg-red-600",
        success: "bg-green-500 active:bg-green-600",
    };

    const sizeClasses = {
        sm: "px-3 py-2",
        md: "px-5 py-3",
        lg: "px-6 py-4",
    };

    const textVariantClasses = {
        primary: "text-white",
        secondary: "text-white",
        outline: "text-amber-500",
        danger: "text-white",
        success: "text-white",
    };

    const textSizeClasses = {
        sm: "text-sm",
        md: "text-base",
        lg: "text-lg",
    };

    const loaderColor = variant === "outline" ? Colors.primary[500] : "#fff";

    return (
        <TouchableOpacity
            className={`flex-row items-center justify-center rounded-xl ${variantClasses[variant]} ${sizeClasses[size]} ${disabled || loading ? "opacity-50" : ""} ${className || ""}`}
            disabled={disabled || loading}
            activeOpacity={0.8}
            {...props}
        >
            {loading ? (
                <ActivityIndicator color={loaderColor} />
            ) : (
                <>
                    {icon}
                    <Text
                        className={`font-semibold ${textVariantClasses[variant]} ${textSizeClasses[size]} ${icon ? "ml-2" : ""}`}
                    >
                        {title}
                    </Text>
                </>
            )}
        </TouchableOpacity>
    );
};
