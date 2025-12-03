import React, { useState } from "react";
import { View, TextInput, Text, TextInputProps, TouchableOpacity } from "react-native";
import { Ionicons } from "@expo/vector-icons";
import { Colors } from "../../constants/colors";

interface InputProps extends TextInputProps {
    label?: string;
    error?: string;
    icon?: keyof typeof Ionicons.glyphMap;
    isPassword?: boolean;
}

export const Input: React.FC<InputProps> = ({
    label,
    error,
    icon,
    isPassword = false,
    className,
    ...props
}) => {
    const [showPassword, setShowPassword] = useState(false);

    return (
        <View className="mb-4">
            {label && <Text className="text-slate-700 font-medium mb-2">{label}</Text>}
            <View
                className={`flex-row items-center bg-slate-100 rounded-xl px-4 ${error ? "border border-red-500" : ""}`}
            >
                {icon && <Ionicons name={icon} size={20} color={Colors.secondary[400]} />}
                <TextInput
                    className={`flex-1 py-3 px-2 text-slate-800 text-base ${className || ""}`}
                    placeholderTextColor={Colors.secondary[400]}
                    secureTextEntry={isPassword && !showPassword}
                    {...props}
                />
                {isPassword && (
                    <TouchableOpacity onPress={() => setShowPassword(!showPassword)}>
                        <Ionicons
                            name={showPassword ? "eye-off-outline" : "eye-outline"}
                            size={20}
                            color={Colors.secondary[400]}
                        />
                    </TouchableOpacity>
                )}
            </View>
            {error && <Text className="text-red-500 text-sm mt-1">{error}</Text>}
        </View>
    );
};
